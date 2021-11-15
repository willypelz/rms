<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientEnvRequest;
use App\Models\SystemSetting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    /**
     * This uses the client_id to fetch the env details and 
     * send it to admin.clientEnv.index blade file
     * 
     * @return view
     */
    public function index()
    {
        $systemSettings =SystemSetting::whereClientId(1)->paginate(30);
        return view('admin.clientEnv.index')->with('clientEnv', $systemSettings);
    }

    /**
     * This returns a particular clients info when passed the id
     * 
     * @param SystemSetting $id is id for SystemSetting
     * 
     * @return view
     */
    public function edit($id)
    {
        $systemSetting = SystemSetting::whereId($id)->first();
        return view('admin.clientEnv.edit')->with('clientEnv', $systemSetting);
    }

    /**
     * This performs the update to SystemSetting
     * 
     * @param ClientEnvRequest $clientEnvRequest a request
     * @param SystemSetting $id is an id of SystemSetting table
     * 
     * @return view to home page
     */
    public function update(ClientEnvRequest $clientEnvRequest, $id)
    {
        $clientEnvDetails = $clientEnvRequest->validated();
        SystemSetting::whereClientIdAndId(1, $id)->update(
            [
                'key' => $clientEnvDetails['key'],
                'value' => $clientEnvDetails['value']
            ]
        );
        session()->flash('success', 'Updated Successfully');
        return redirect(route('index-env'));
    }

    public function delete($id)
    {
        SystemSetting::whereClientIdAndId(1, $id)->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect(route('index-env'));
    }
}
