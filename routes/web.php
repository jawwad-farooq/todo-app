<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('second');
});

Route::delete('deletetask/{id}', [TaskController::class, 'deleteTask']);

Route::post('updatetask/{id}',[TaskController::class, 'updateTask']);


// Route::group(['middleware' => ['auth']], function () {
    Route::get('showtask',[TaskController::class,'showTask']);

    Route::post('newtask',[TaskController::class,'newTask']);
    Route::view('welcome', '/welcome');
// });
Route::view('second', '/second');
Route::view('userss', '/userss');

// Route::get('/second', function () {
//     return view('second');
// });
Route::post('login',[UserController::class,'Login']);

Route::post('user',[UserController::class,'getData']);
Route::view('user','message');

Route::get('ajax',function(){
    return view('message');
});

// Route::post('/getmsg','AjaxController@index');
Route::get('/getmsg',[AjaxController::class,'index']);  