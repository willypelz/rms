<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientEnvRequest;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public $systemSetting;

    public function __construct()
    {
        $this->systemSettings = SystemSetting::whereClientId(1)->get();
    }
    //get env details by client
    public function index()
    {
        return view('admin.clientEnv.index')->with('clientEnv', $this->systemSettings);
    }

    public function edit($id)
    {
        $systemSetting = SystemSetting::whereId($id)->first();
        return view('admin.clientEnv.edit')->with('clientEnv', $systemSetting);
    }

    public function update(ClientEnvRequest $clientEnvRequest)
    {
        $clientEvnDetails = $clientEnvRequest->validated();
        $this->systemSetting->update([

        ]);

        return redirect(route('index-env'));
    }
}
