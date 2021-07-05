<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Validator;

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

    public function adminAcceptInvite(Request $request)
    {
       
        $user = User::where('user_token', $request->id)->first();
        $company = Company::find($request->company_id);
        $role = Role::whereName('admin')->first();
        if ($user) {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required|confirmed|min:6',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $user->password = bcrypt($request->password);
                $user->activated = 1;
                $user->save();
                
                $assoc = DB::table('company_users')->insert([
                    ['user_id' => $user->id, 'company_id' => $request->company_id, 'role_id' => '1']
                ]);
                
                $user->roles()->sync([$role->id]);
                User::where('user_token', $request->id)->update(['user_token' => null]);
                return redirect()->route('login');
            } else {
                return view('job.admin-accept', compact('user', 'company'));
            }
        }
        return redirect()->route('dashboard');
    }

}
