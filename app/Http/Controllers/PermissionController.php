<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function NewPermission(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'role' => 'required'
        ]);

        $premission = Permission::create(['name' => $request->input('name')]);
        $premission->syncPermissions($request->input('role'));

        return response([
            'success' => 'Permission Created '.$premission->name.' Successfuly'
        ]);
    }
    public function ShowRoles(){
        $roles = Role::all();
        return view('create-permission', ['roles' => $roles]);
    }

    
}
