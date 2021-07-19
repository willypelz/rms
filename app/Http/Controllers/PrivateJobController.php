<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivateJob;

class PrivateJobController extends Controller
{
    public function destroy($id)
    {
        $privateEmail = PrivateJob::find($id);
        $privateEmail->delete();
        return redirect()->back()->with('success', 'Attached email was successfully removed');
    }
}
