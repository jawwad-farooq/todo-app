<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    public function NewRole(Request $request) {
        $this->validate($request,[
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return response([
            'success' => 'New Role '.$role->name.' Created Successfuly'
        ]);
    }

    public function ShowPremissions(){
        $permissions = Permission::all();
        return view('create-role', ['permissions' => $permissions]);
    }
}
