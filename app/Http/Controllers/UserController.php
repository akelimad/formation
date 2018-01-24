<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function users(){
        $users = User::with('roles')->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function createUser(){
        ob_start();
        $roles = Role::all();
        echo view('users.create', ['roles'=> $roles]);
        $content = ob_get_clean();
        return ['title' => 'Ajouter un utilisateur', 'content' => $content];
    }

    public function storeUser(Request $request){
        $id = $request->input('id', false);
        if($id) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if(!empty($request->password) || !empty($request->password_confirmation)){
                $rules = [
                    'password' => 'required|min:6|confirmed',
                ];
                $validator = \Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return ["status" => "danger", "message" => $validator->errors()->all()];
                }
                $user->password = bcrypt($request->password);
            }
            $user->detachRoles( $user->roles );
            $user->attachRole( $request->role );
            $user->save();
        } else {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return ["status" => "danger", "message" => $validator->errors()->all()];
            }
            $user = new User();
            $user->name= $request->name;
            $user->email= $request->email;
            $user->password= bcrypt($request->password);
            $user->save();
            // Give each new user the role selected
            $role = $request->role;
            $user->attachRole( $role );
        }
        if($user->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function editUser($id){
        ob_start();
        $user = User::find($id);
        $roles_ids = [];
        if($user->roles){
            foreach($user->roles as $role){
                $roles_ids []= $role->id;
            }
        }
        $roles = Role::all();
        echo view('users.edit', compact('user', 'roles','roles_ids'));
        $content = ob_get_clean();
        return ['title' => 'Modifier un utilisateur', 'content' => $content];
    }
    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password) || !empty($request->password_confirmation)){
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->detachRoles( $user->roles );
        $user->attachRole( $request->role );
        $user->save();
        return redirect('utilisateurs');
    }

    public function destroyUser(Request $request, $id){
        $user = User::find($id);
        $user->delete();
        return redirect('utilisateurs');
    }

    public function roles(){
        $roles = Role::paginate(10);
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
        $permissions = Permission::paginate(10);
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
