<?php


namespace App\Http\Controllers;



use App\Enum\Configs;

use App\Http\Requests\UpdatePolicyRequest;

use App\Models\Settings;

use Auth;

use Illuminate\Http\Request;



class PrivacyPolicyController extends Controller

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



	public function setPrivacyPolicy()

	{

		$privacy_policy = $this->settings->getWithoutPluck(Configs::PRIVACY_KEY);

		return view('settings.privacy_policy', compact('privacy_policy'));

	}


	public function savePrivacyPolicy(UpdatePolicyRequest $request)

	{

		$this->settings->setKeyIfNotExist(Configs::PRIVACY_KEY, $request->privacy_policy_url);

		return back()->with('success', "Configuration updated successfully.");


	}


}
