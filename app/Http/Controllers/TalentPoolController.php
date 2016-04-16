<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TalentPoolController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AddCandidates($id){

        return view ('talent-pool.add-candidates');
    }
}
