<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Auth;

class AdminsController extends Controller
{
    
     public function manageRoles(Request $request)
     {
     	
     	$users = User::with('roles')->get();
        $roles = Role::get();
        
        return view ('admin.roles.index', compact ('users', 'roles'));

     }


     public function createRole(Request $request)
     {

     	$permissions = Permission::get();
        $rolePermissions = [];

        if($request->isMethod('post')){
        	
        	$role = Role::FirstorCreate(['name' => $request->name, 'display_name' =>$request->display_name, 'description' => $request->description ]);

        	$role->perms()->attach($request->permissions);
        	
            return redirect()->route('list-role')->with('success', 'Role has been successfully added.');
        }


     	
        return view ('admin.roles.create', compact ('permissions', 'rolePermissions', 'role'));
     }


     public function editRole(Request $request, $id)
     {
	
		$permissions = Permission::get();
		$role = Role::findOrFail($id);
        $rolePermissions = $role->perms()->pluck('id')->toArray();

        $user = Auth::user();

        if($request->isMethod('post')){
        	$role->perms()->detach();
            $role->perms()->attach($request->permissions);

            $role->update(['name' => $request->name, 'display_name' =>$request->display_name, 'description' => $request->description ]);
            
            return redirect()->route('list-role')->with('success', 'Successfully updated');
        }


        return view ('admin.roles.edit', compact ('permissions', 'rolePermissions', 'role'));
     }


     public function deleteRole($id)
     {
     	# code...
     }

}
