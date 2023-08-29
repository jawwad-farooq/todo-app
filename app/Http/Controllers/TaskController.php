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

    // public function showTask()
    // {
    //     // $tasks = Task::where('user_id', $userId)->get();
    //     $tasks = Task::all();
    //     // return view('words.index', ['task' => $tasks]);
    //     // return view('welcome',['rows'=>$tasks]);
    //     return response()->json($tasks);
    // }

    // public function showUserID($userID)
    public function showTask($userID)
    {
        // $tasks = Task::where('user_id', $userId)->get();
        $current = Task::where('user_id', $userID)->get();
        // return view('words.index', ['task' => $tasks]);
        // return view('welcome',['rows'=>$tasks]);
        if(!$userID){
            return response()->json([
                'error' => 'user not found'
            ], 404);
        }
        else{
            return response()->json($current);
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
        $task->check = $request->input('isCheckedy') ? 'done' : null;
        $task->save();
        return response()->json(['success'=>true]);
    }
}
