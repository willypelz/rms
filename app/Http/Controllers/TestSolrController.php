<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AtsProduct;
use App\Models\AtsService;
use App\Models\CompanyTest;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TestSetupRequest;
use App\Jobs\UploadSolrFromCode;

class TestSolrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.test-solr');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function runSolrUpdate(Request $request)
    {
        UploadSolrFromCode::dispatch();
        return redirect()->back()->with(["status" => "success", "msg" => ""]);
    }

}
