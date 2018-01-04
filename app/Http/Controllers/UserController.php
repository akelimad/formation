<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin', ['except' => ['users','roles']]);
    }

    public function users(){
        $users = User::with('roles')->get();
        return view('users.index', ['users' => $users]);
    }

    public function roles(){
        $roles = Role::all();
        return view('users/roles.index' , ['roles' => $roles]);
    }
    public function createRole(){
        $permissions = Permission::all();
        return view('users/roles.create', ['permissions' => $permissions]);
    }
    public function storeRole(Request $request){
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role->attachPermissions($request->permissions);
        return redirect('utilisateurs/roles');
    }

    public function permissions(){
        $permissions = Permission::all();
        return view('users/permissions.index' ,['permissions' => $permissions]);
    }
    public function createPermission(){
        return view('users/permissions.create');
    }
    public function storePermission(Request $request){
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
        return redirect('utilisateurs/permissions');
    }




}
