<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    function printing (){
        return 'hello world';
    }
    function getData(Request $req){
        $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        
        $member = new User;
        $member->name=$req->name;
        $member->password=$req->password;
        $member->save();
        return redirect('user');
    }

    function Login(Request $request) {
        $username = $request->input('name');
        $password = $request->input('password');
    
        $user = User::where('name', $username)->where('password', $password)->first();
    
        if ($user !== null) {
            return redirect('welcome');
        } else {
            return redirect('user')->with('error', 'Invalid credentials. Please try again.');
        }
    }
}
