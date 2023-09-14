<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id);

        $validatedData = $request->validate([
            'status' => 'nullable|in:todo,done',
            'priority' => 'nullable|integer|min:1|max:5',
            'title' => 'nullable|string',
            'sortBy' => 'nullable|in:priority,createdAt,completedAt',
            'sort' => 'nullable|in:ASC,DESC',
        ]);

        if ($validatedData['status'])
            $tasks->where('status', $validatedData['status']);

        if ($validatedData['priority'])
            $tasks->where('priority', $validatedData['priority']);

        if ($validatedData['title'])
            $tasks->where('title', 'like', "%". $validatedData['title'] ."%");

        $validatedData['sort'] = $validatedData['sort']?$validatedData['sort'] : 'DESC';
        if ($validatedData['sortBy'])
            $tasks->orderBy($validatedData['sortBy'], $validatedData['sort']);

        return response()->json($tasks->paginate(10));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:todo,done',
            'priority' => 'required|integer|min:1|max:5',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
        ]);

        $task = new Task($validatedData);
        $task->user_id = Auth::id();
        $task->save();

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task)
            return response()->json(['message' => 'Задача не найдена'], 404);

        if ($task->user_id !== auth()->user()->id)
            return response()->json(['message' => 'У вас нет доступа к этой задаче'], 403);

        $validatedData = $request->validate([
            'priority' => 'nullable|integer',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validatedData['priority'])
            $task->priority = $validatedData['priority'];

        if ($validatedData['title'])
            $task->title = $validatedData['title'];

        if ($validatedData['description'])
            $task->description = $validatedData['description'];

        if ($validatedData)
            $task->save();

        return response()->json(['message' => 'Задача обновлена'], 200);
    }

    public function complete(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task)
            return response()->json(['message' => 'Задача не найдена'], 404);

        if ($task->user_id !== auth()->user()->id)
            return response()->json(['message' => 'У вас нет доступа к этой задаче'], 403);

        if ($task->completedAt)
            return response()->json(['message' => 'Задача выполнена'], 200);

        $isSubtask = Task::where(['parent_id' => $task->id, 'status' => 'todo'])->count();
        if ($isSubtask)
            return response()->json(['message' => 'Есть невыполненные подзадачи'], 200);

        $task->status = "done";
        $task->completedAt = Carbon::now()->format('Y-m-d H:i:s');
        $task->save();

        return response()->json(['message' => 'Задача выполнена'], 200);
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if (!$task)
            return response()->json(['message' => 'Задача не найдена'], 404);

        if ($task->user_id !== auth()->user()->id)
            return response()->json(['message' => 'У вас нет доступа к этой задаче'], 403);

        if ($task['status'] == 'done')
            return response()->json(['message' => 'Задача выполнена'], 200);

        $task->delete();
        return response()->json(['message' => 'Задача удалена'], 200);
    }
}
