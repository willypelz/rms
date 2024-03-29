<?php

namespace App\Http\Controllers;


use App\Enum\Configs;
use App\Http\Requests\SyncCompanyRequest;
use App\Models\Company;
use App\Models\Role;
use App\User;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;


class SyncUserToCompanyController extends Controller
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
	 * Show the user company attachment dashboard.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function syncUserToCompanyIndex(Request $request)
	{
		$companies = Company::where('is_active',1)->where('client_id', $request->clientId)->get();
		$user = User::find(base64_decode($request->user_id));
		$userCompanies = $user->companies->where('client_id', $request->clientId)->pluck('id')->toArray();
		mixPanelRecord('Attach New User Start (Admin)', auth()->user());
		return view('settings.sync_user_to_company', compact('companies','userCompanies','user'));
	}

	/**
	 * Sync user to selected companies.
	 *
	 * @param SyncCompanyRequest $request
	 * @param Role $role
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function syncUserToCompany(SyncCompanyRequest $request)
	{
		try{
		$role = Role::whereName('admin')->first();
		$user = User::find($request->user_id);
		$companies = Company::find($request->companies)->where('client_id', $request->clientId)->pluck('id')->toArray();
		$action = $user->companies()->count() > count($companies) ? 'detached from company' : 'attached to more companies';
		//attach the user to all selected companies
		$user->companies()->sync(array_fill_keys($companies,['role' => $role->id, 'role_id'=>$role->id]),true);
			// $user->roles()->sync([$role->id]);
		mixPanelRecord('Attach New User Successfully (Admin)', auth()->user());
		return redirect()->back()->with('success', ucwords("{$user->name} $action successfully"));

		}catch(\Exception $e){
			return redirect()->back()->with('error', 'Something went wrong, please try again');
		}
	}

}
