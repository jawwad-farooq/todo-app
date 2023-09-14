<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;

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

    public function Edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name','name')->all();
     
        return view('edit-user',compact('user','roles','userRole'));
    }

    public function Update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes|nullable|min:6',
            'role' => 'required'
        ]);
     
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // $user->password=Hash::make($request->input('password'));

        if($request->input('password')){ 
            $user->password = Hash::make($request->input('password'));
        }else{
            $user = Arr::except($user,array('password'));    
        }
     
        $user->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('role'));
        
     
        return redirect('all-users')->with('success','User updated successfully');
        // return response()->json([
        //     'success' => 'updated user'
        // ]);
    }

    // public function __invoke(){
    //     return view('welcome', [
    //         'user' => auth()->user()
    //     ]);
    // }

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

    function DeleteUser($id) {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'error' => 'user not found'
            ]);
        }
        $user->delete();
        return response()->json([
            'success' => 'user deleted'
        ]);
    }
}
