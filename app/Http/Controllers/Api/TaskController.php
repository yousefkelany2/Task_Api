<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{
    protected $guard;

    public function __construct()
    {
        $this->guard = 'api';
    }
    public function index()
    {
        $tasks = auth($this->guard)->user()->tasks;
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'dueDate' => 'required|date',
        ]);

        $task = Task::create([
            'user_id' =>  auth($this->guard)->id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->dueDate,
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $task = auth($this->guard)->user()->tasks()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'dueDate' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title ?? $task->title,
            'description' => $request->description ?? $task->description,
            'due_date' => $request->dueDate ?? $task->due_date,
        ]);

        return response()->json($task);
    }

    public function destroy($id)
    {
        try {
            $task = auth($this->guard)->user()->tasks()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function changeStatus(Request $request, $id)
    {
        $task = auth($this->guard)->user()->tasks()->findOrFail($id);

        $request->validate([
            'isCompleted' => 'required|boolean',
        ]);

        $task->is_completed = $request->isCompleted;
        $task->save();

        return response()->json($task);
    }
}
