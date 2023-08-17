<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            'password' => 'required'
        ]);
        
        $member = new User;
        $member->name=$req->name;
        $member->password=$req->password;
        $member->save();
        return redirect('user');
    }

    public function __invoke(){
        return view('welcome', [
            'user' => auth()->user()
        ]);
    }

    function Login(Request $request) {

        // $user = User::where("name", $request->input('name'))->get();
        // return redirect('/welcome');

        $username = $request->input('name');
        $password = $request->input('password');
        // $userID = User::where('id');
        $user = User::where('name', $username)->where('password', $password)->first();
        $request->session()->put('user', $user);
        // $request->session()->put('userID', $userID);

        if ($user !== null) {
            return redirect('welcome');
        } else {
            return redirect('user')->with('error', 'Invalid credentials. Please try again.');
        }

        // validator(request()->all(),[
        //     'name' => 'required',
        //     'password' => 'required'
        // ])->validate();

        // if (auth()->attempt(request()->only(['name','password']))) {
        //     return redirect('/welcome');
        // }
        
        // return redirect()->back()->withErrors(['name' => 'invalid']);
        
    }

    public function logout(){
        Session::flush();
        return redirect('user');
    }
}
