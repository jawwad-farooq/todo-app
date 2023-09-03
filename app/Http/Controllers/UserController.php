<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Session;

class UserController extends Controller
{
    //
    function printing (){
        return 'hello world';
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
