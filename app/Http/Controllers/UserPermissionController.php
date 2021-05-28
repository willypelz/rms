<?php

namespace App\Http\Controllers;


use App\Enum\Configs;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;


class UserPermissionController extends Controller
{

	protected $settings;

	/**
	 * Create a new controller instance.
	 *
	 * @param Settings $settings
	 */
	public function __construct(Settings $settings)
	{
		$this->settings = $settings;
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function userPermissionPage()
	{
	    $roles = Role::with('permissions')->get();
	    $permissions = Permission::all();
		return view('settings.user_permission', compact(  'roles', 'permissions'));
	}

}
