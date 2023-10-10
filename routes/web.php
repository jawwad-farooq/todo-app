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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
 
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=1025
MAIL_USERNAME=jawadmuhamad786@gmail.com
MAIL_PASSWORD=gvux cubh asgq omov
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=jawadmuhamad786@gmail.com
MAIL_FROM_NAME="todo app"
*/



// Route::get('logout', [UserController::class, 'logout']);
// Route::get('create-roles', [RoleController::class, 'ShowPremissions']);
// Route::get('create-permission', [PermissionController::class, 'ShowRoles']);
// Route::get('showtask/{userID}', [TaskController::class, 'showTask']);
// Route::get('showuserid/{userID}', [TaskController::class, 'showUserID']);
// Route::get('all-users', [UserController::class, 'showUsers']);
// Route::get('edit-user/{id}', [UserController::class, 'Edit']);

// Route::delete('deletetask/{id}', [TaskController::class, 'deleteTask']);
// Route::delete('delete-user/{id}', [UserController::class, 'DeleteUser']);

// Route::post('updatetask/{id}', [TaskController::class, 'updateTask']);
// Route::post('newtask', [TaskController::class, 'newTask']);
// Route::post('user', [UserController::class, 'getData']);
// Route::post('new-roles', [RoleController::class, 'NewRole']);
// Route::post('new-permission', [PermissionController::class, 'NewPermission']);
// Route::post('login', [UserController::class, 'Login']);
// Route::post('update-user/{id}', [UserController::class, 'Update']);

Route::group(['Middleware' => "web"], function () {
    Route::view('sign-in', 'sign-in');
    Route::view('welcome', '/welcome');
    Route::view('/', '/sign-up');
        
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('create-roles', [RoleController::class, 'ShowPremissions']);
    Route::get('create-permission', [PermissionController::class, 'ShowRoles']);
    Route::get('showtask/{userID}', [TaskController::class, 'showTask']);
    Route::get('showuserid/{userID}', [TaskController::class, 'showUserID']);
    Route::get('all-users', [UserController::class, 'showUsers']);
    Route::get('edit-user/{id}', [UserController::class, 'Edit']);

    Route::delete('deletetask/{id}', [TaskController::class, 'deleteTask']);
    Route::delete('delete-user/{id}', [UserController::class, 'DeleteUser']);

    Route::post('updatetask/{id}', [TaskController::class, 'updateTask']);
    Route::post('newtask', [TaskController::class, 'newTask']);
    Route::post('user', [UserController::class, 'getData']);
    Route::post('new-roles', [RoleController::class, 'NewRole']);
    Route::post('new-permission', [PermissionController::class, 'NewPermission']);
    Route::post('login', [UserController::class, 'Login']);
    Route::post('update-user/{id}', [UserController::class, 'Update']);
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('ajax', function () {
    return view('message');
});

Route::get('/getmsg', [AjaxController::class, 'index']);