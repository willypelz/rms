<?php

namespace App\Http\Controllers;


use App\Enum\Configs;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Company;
use App\Models\Settings;
use Auth;
use Illuminate\Http\Request;


class SettingsController extends Controller
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
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function showSettings()
	{
		$company = Company::whereIsDefault(true)->first();
		return view('settings.index', compact('company'));
	}

}
