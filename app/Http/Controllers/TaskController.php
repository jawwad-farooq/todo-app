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
        $task->id=$request->user_id;
        $task->taskname=$request->input('task_name');
        $task->save();

        return response()->json([]);
    }

    function showTask() {
        $task = Task::all();
        // dd($task);
        return response()->json([
            'task' => $task
        ]);
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
        // $task = Task::find($id);
        // $task->check=$request->has('checkmark') ? $request->input('checkmark') : null;
        $task = Task::find($id);
        // $isChecked = $request->input('isChecked');
    
        // Update the checkbox value in the database
        $task->check = $request->input('isChecked') ? 'done' : null;
        $task->save();
        return response()->json(['success'=>true]);
    }
}
