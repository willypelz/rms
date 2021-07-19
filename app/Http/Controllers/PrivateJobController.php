<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivateJob;
use App\Exports\PrivateJobEmailTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class PrivateJobController extends Controller
{
    public function destroy($id)
    {
        $privateEmail = PrivateJob::find($id);
        $privateEmail->delete();
        return redirect()->back()->with('success', 'Attached email was successfully removed');
    }

    public function exportCsvTemplate(){
    $file= public_path()."/downloads/email-template.csv";

    $headers = array(
              'Content-Type: text/csv',
            );
    return response()->download($file, 'email-template.csv', $headers); 
    }
}
