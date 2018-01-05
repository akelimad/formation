<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{

    public function users(){
        $users = User::with('roles')->get();
        return view('users.index', ['users' => $users]);
    }
    public function destroyUser(Request $request, $id){
        $user_loged = Auth::user()->id;
        $user = User::find($id);
        $user->delete();
        return redirect('users.index');
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
        $role->perms()->detach($request->permissions);
        $role->attachPermissions($request->permissions);
        return redirect('utilisateurs/roles');
    }
    public function editRole($id){
        $role = Role::find($id);
        $role_perms = [];
        foreach ($role->perms()->get() as $perm) {
            $role_perms[] = $perm->id;
        }
        $permissions = Permission::all();
        return view('users/roles.edit' , ['role' => $role, 'permissions' => $permissions,'role_perms' => $role_perms]);
    }
    public function updateRole(Request $request, $id){
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role_perms = [];
        foreach ($role->perms()->get() as $perm) {
            $role_perms[] = $perm->id;
        }
        if($request->permissions){
            $role->perms()->detach($role_perms);
            $role->perms()->attach($request->permissions);
        }
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
    public function editPermission($id){
        $p = Permission::find($id);
        return view('users/permissions.edit' ,['p' => $p]);
    }
    public function updatePermission(Request $request, $id){
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
        return redirect('utilisateurs/permissions');
    }


    public function rolePermissions(){
        $roles = Role::all();
        foreach (Route::getRoutes() as $Route) {
            $routes[] = [
                'methods' => $Route->getMethods(),
                'path' => $Route->getPath(),
                'action' => $Route->getActionName(),
            ];
        }
        //dd($routes['path']);
        return view('users/role_permissions.index',[
            'routes'=> $routes,
            'roles' => $roles
        ]);
    }


}
