<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(IndexTaskRequest $request, TaskService $taskService): JsonResponse
    {
        $tasks = $taskService->getTasksByFilters( $request->validated());

        return response()->json($tasks);
    }

    public function create(CreateTaskRequest $request, TaskService $taskService): JsonResponse
    {
        try {
            $task = $taskService->create($request->validated());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create task', 'error' => $e->getMessage()], 500);
        }

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, TaskService $taskService, $id): JsonResponse
    {
        try {
            $task = $taskService->update($id, $request->validated());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update task', 'error' => $e->getMessage()], 500);
        }

        return response()->json($task);
    }

    public function complete(TaskService $taskService, $id): JsonResponse
    {
        try {
            $task = $taskService->complete($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to complete task', 'error' => $e->getMessage()], 500);
        }

        return response()->json($task);
    }

    public function delete(TaskService $taskService, $id)
    {
        try {
            $taskService->delete($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete task', 'error' => $e->getMessage()], 500);
        }

        return response()->json(null, 204);
    }
}
