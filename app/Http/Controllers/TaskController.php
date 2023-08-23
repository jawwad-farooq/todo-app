<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //
    function newTask(Request $request){
        // $user = Auth::user();

        $task = new Task;
        $task->user_id=$request->user_id;
        $task->taskname=$request->input('task_name');
        $task->save();

        return response()->json([]);
    }

    public function showTask($userId)
    {
        try {
            $tasks = Task::where('user_id', $userId)->get();
            return response()->json($tasks)->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching tasks.'
            ], 500);
        }
    }


    function deleteTask($id){
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['success'=>true]);
    }

    function updateTask(Request $request, $id){
        $task = Task::find($id);
        $task->check = $request->input('isChecked') ? 'done' : null;
        $task->save();
        return response()->json(['success'=>true]);
    }
}
