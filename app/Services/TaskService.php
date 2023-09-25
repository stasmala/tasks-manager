<?php

namespace App\Services;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\SubtasksExistException;
use App\Exceptions\TaskCompletedException;
use App\Exceptions\TaskNotFoundException;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function getTasksByFilters(array $filters): LengthAwarePaginator
    {
        $tasks = Task::where('user_id', auth()->user()->id);

        if (isset($filters['status'])) {
            $tasks->where('status', $filters['status']);
        }

        if (isset($filters['priorityMin'])) {
            $tasks->where('priority', '>=', $filters['priorityMin']);
        }

        if (isset($filters['priorityMax'])) {
            $tasks->where('priority', '<=', $filters['priorityMax']);
        }

        if (isset($filters['title'])) {
            $title = $filters['title'];
            $tasks->where(function ($query) use ($title) {
                $query->where('title', 'like', "%$title%")
                    ->orWhere('title', 'like', "$title%")
                    ->orWhere('title', 'like', "%$title");
            });
        }

        if (isset($filters['sortBy'])) {
            $sort = isset($filters['sort']) ? $filters['sort'] : 'DESC';
            $tasks->orderBy($filters['sortBy'], $sort);
        }

        return $tasks->paginate(10);
    }

    public function create(array $data): Task
    {
        $task = new Task($data);
        $task->user_id = auth()->user()->id;
        $task->save();

        return $task;
    }

    public function update(int $id, array $data): Task
    {
        $task = Task::find($id);

        if (!$task)
            throw new TaskNotFoundException('Task not found');

        if ($task->user_id !== auth()->user()->id)
            throw new AccessDeniedException('You do not have access to this task');

        if (isset($data['priority'])) {
            $task->priority = $data['priority'];
        }

        if (isset($data['title'])) {
            $task->title = $data['title'];
        }

        if (isset($data['description'])) {
            $task->description = $data['description'];
        }

        $task->save();

        return $task;
    }

    public function complete($id): Task
    {
        $task = Task::find($id);
        if (!$task)
            throw new TaskNotFoundException('Task not found');

        if ($task->user_id !== auth()->user()->id)
            throw new AccessDeniedException('You do not have access to this task');

        if ($task->completedAt)
            return $task;

        $isSubtask = Task::where('parent_id', $task->id)->where('status', 'todo')->exists();
        if ($isSubtask)
            throw new SubtasksExistException('There are outstanding subtasks');

        $task->status = "done";
        $task->completedAt = Carbon::now()->format('Y-m-d H:i:s');
        $task->save();

        return $task;
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if (!$task)
            throw new TaskNotFoundException('Task not found');

        if ($task->user_id !== auth()->user()->id)
            throw new AccessDeniedException('You do not have access to this task');

        if ($task->status == 'done')
            throw new TaskCompletedException('Task completed');

        $task->delete();
    }
}
