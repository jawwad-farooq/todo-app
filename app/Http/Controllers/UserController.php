<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Session;

class UserController extends Controller
{
    //https://www.tutsmake.com/laravel-8-user-roles-and-permissions-tutorial-example/#google_vignette
    function showUsers (){
        // $users = User::all();
        // return view('all-users',['users' => $users]);

        $user = User::all();
        $roles = Role::pluck('name','name')->all();
     
        return view('all-users',compact('user','roles'));
    }

    
    
    function getData(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $username = $req->input('name');

        $member = User::where('name', $username)->first();

        if(!$member){
            $member = new User;
            $member->name=$req->name;
            $member->email=$req->email;
            $member->password=Hash::make($req->input('password'));
            $member->save();
            return redirect('sign-in');
        }
        return back()->with('error', 'User already exist');    
    }

    public function __invoke(){
        return view('welcome', [
            'user' => auth()->user()
        ]);
    }

    function Login(Request $request) {

        $username = $request->input('name');
        $password = $request->input('password');

        $user = User::where('name', $username)->first();
        $request->session()->put('user', $user);

        if ($user !== null && Hash::check($password, $user->password)) {
            return redirect('welcome');
        } else {
            return redirect('sign-in')->with('error', 'Invalid credentials. Please try again.');
        }        
    }

    public function logout(){
        Session::flush();
        return redirect('sign-in');
    }
}
