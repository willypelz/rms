<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $company = Company::find(get_current_company()->id);

        return view('internal-recruitment.api-key', [
            'CurrentCompany' => $company
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'generate_key' => 'required|integer',
        ]);

        if ($request->input('generate_key') && Company::find(get_current_company()->id)->update(['api_key' => (string)Uuid::generate(4)])) {
            // return a success message
            return redirect()
                ->back()
                ->with('success', 'API key generated successfully');
        }

        return redirect()
            ->back()
            ->with('error', 'API key can not be generated successfully, Please try again later');
    }

}
