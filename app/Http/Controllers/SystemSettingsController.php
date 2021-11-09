<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientEnvRequest;
use App\Models\SystemSetting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function index()
    {
        $systemSettings =SystemSetting::whereClientId(1)->get();
        return view('admin.clientEnv.index')->with('clientEnv', $systemSettings);
    }

    public function edit($id)
    {
        $systemSetting = SystemSetting::whereId($id)->first();
        return view('admin.clientEnv.edit')->with('clientEnv', $systemSetting);
    }

    public function update(ClientEnvRequest $clientEnvRequest, $id)
    {
        $clientEnvDetails = $clientEnvRequest->validated();

        SystemSetting::whereClientIdAndId(1,$id)->update([
            'key' => $clientEnvDetails['key'],
            'value' => $clientEnvDetails['value']
        ]);

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
