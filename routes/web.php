<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Session;
use App\Http\Middleware\checkAge;

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



Route::get('logout', [UserController::class, 'logout']);
Route::get('create-roles', [RoleController::class, 'ShowPremissions']);
Route::get('create-permission', [PermissionController::class, 'ShowRoles']);
Route::get('showtask/{userID}', [TaskController::class, 'showTask']);
Route::get('showuserid/{userID}', [TaskController::class, 'showUserID']);
Route::get('all-users', [UserController::class, 'showUsers']);
Route::get('edit-user/{id}', [UserController::class, 'Edit']);

Route::delete('deletetask/{id}', [TaskController::class, 'deleteTask']);

Route::post('updatetask/{id}', [TaskController::class, 'updateTask']);
Route::post('newtask', [TaskController::class, 'newTask']);
Route::post('user', [UserController::class, 'getData']);
Route::post('new-roles', [RoleController::class, 'NewRole']);
Route::post('new-permission', [PermissionController::class, 'NewPermission']);
Route::post('login', [UserController::class, 'Login']);
Route::post('update-user/{id}', [UserController::class, 'Update'])->name('update-user');

Route::group(['Middleware' => "web"], function () {
    Route::view('sign-in', 'sign-in');
    Route::view('welcome', '/welcome');
    Route::view('/', '/sign-up');
});


Route::get('ajax', function () {
    return view('message');
});

Route::get('/getmsg', [AjaxController::class, 'index']);