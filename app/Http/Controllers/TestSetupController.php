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

class TestSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $created_test_id = get_current_company()->companyAtsProductTests->pluck('ats_product_id');
            $created_products = AtsProduct::find($created_test_id);
            $tests = AtsService::where('type','TEST')->get();
            $company = base64_encode(get_current_company()->name);
            $response = Curl::to(env('SEAMLESS_QUESTION_APP_URL').'/company-test-names/'.$company)->get();  
            if($response && json_decode($response)->status == true){
                $test_names = json_decode($response)->data;
               
            }else{
                $test_names = [];
            }
            return view('admin.test-setup', compact('tests','test_names','created_products'));
        }catch(\Exception $e){
           return back()->with('error','Something went wrong');
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TestSetupRequest $request)
    {
        try{
            DB::transaction(function () use($request) {
                $time =  Carbon::now()->toDateTimeString();
                $ats_service = AtsService::firstOrCreate(['name'=>!empty($request->test_id) ? $request->test_id : $request->test_type],
                [
                    'description' =>$request->test_desc,
                    'type'=> 'TEST',
                    'active'=>1,
                    'created' =>$time,
                    'modified'=> $time
                ]);
                
                $ats_product = AtsProduct::firstOrCreate([
                    'ats_service_id'=>$ats_service->id,
                    'name' => $request->test_name,
                    'ats_provider_id' => 3, //insidfy ID
                ],
                [
                    'summary' => $request->test_summary,
                    'details' => $request->test_details ?? null,
                    'active' => 1,
                    'modified' => $time 
                ]);

                $company_tests = CompanyTest::firstOrCreate([
                    'ats_product_id' => $ats_product->id,
                    'company_id' => get_current_company()->id,
                    'date_added' => $time
                ]);
            });
            return back()->with('success', 'Test setup successfully');
        }catch(\Exception $e){
            return back()->with('error','Something went wrong during creation, pleae try again');
        }
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
