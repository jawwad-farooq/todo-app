<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    function newTask(Request $request)
    {
        $task = new Task;
        $task->user_id = $request->user_id;
        $task->taskname = $request->input('task_name');
        $task->save();

        return response()->json([]);
    }

    public function showTask($userID)
    {
        $current = Task::where('user_id', $userID)->get();
        if (!$userID) {
            return response()->json([
                'error' => 'user not found'
            ], 404);
        } else {
            return response()->json($current);
        }
    }

    function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['success' => true]);
    }

    function updateTask(Request $request, $id)
    {
        $task = Task::find($id);
        $task->check = $request->input('isCheckedy') ? 'done' : null;
        $task->save();
        return response()->json(['success' => true]);
    }
}