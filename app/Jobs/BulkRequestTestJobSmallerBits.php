<?php

namespace App\Jobs;

use Curl;
use App\Models\OrderItem;
use App\Models\TestRequest;
use Illuminate\Bus\Queueable;
use App\Models\JobApplication;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BulkRequestTestJobSmallerBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $key, $test, $order, $request, $current_company,$idBatch;
    public function __construct($key, $test, $order, $request, $current_company,$idBatch)
    {
        $this->key = $key;
        $this->test = $test;
        $this->order = $order;
        $this->request = (object) $request;
        $this->current_company = $current_company;
        $this->idBatch = $idBatch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key = $this->key;
        $test = $this->test;
        $order = $this->order;
        $request = $this->request;
        $current_company = $this->current_company;
        $test_ids = [];
        $idBatch = $this->idBatch;
        try{
            foreach ($idBatch as $key3 => $app_id) {
                
                $data = [
                    'location' => @$request->location,
                    'start_time' => @$request->start_time,
                    'end_time' => @$request->end_time,
                    'job_application_id' => $app_id,
                    'test_id' => $test['id'],
                    'test_name' => $test['name'],
                    'test_owner' => $test['owner'],
                    // 'order_id' => $order->id,
                    'order_id' => null,
                    // 'status'=> 'ORDER'
                    'status' => 'PENDING'

                ];

                // save_activities('TEST_ORDER', @$request->job_id, $request->app_ids );

                $mustBeUnique = ['job_application_id' => $app_id, 'test_id' => $test['id']];

                $test_request = TestRequest::updateOrCreate($mustBeUnique, $data);
                $test_ids[] = $test_request->id;

                $app = JobApplication::with('cv')->find($app_id);

                JobApplication::massAction(@$request->job_id, @$request->cv_ids, $request->step, $request->stepId);

                $testUrl = getEnvData('SEAMLESS_TESTING_APP_URL', env('SEAMLESS_TESTING_APP_URL')).'/test-request';
                $data = [
                    'job_title' => $app->job->title,
                    'test_id' => $data['test_id'],
                    'job_application_id' => $app_id,
                    'applicant_name' => ucwords(@$app->cv->first_name . " " . @$app->cv->last_name),
                    'applicant_email' => $app->cv->email,
                    'employer_name' => $current_company->name,
                    'employer_email' => $current_company->email,
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'webhook_url' => companyRoute($request->clientId, 'save-test-result'),
                ];
                $ch = curl_init($testUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // execute!
                $response = curl_exec($ch);

                // close the connection, release resources used
                curl_close($ch);
                // Leave this next line untouched, its imperative
                dump($response);
            }
        }catch(\Exception $e){
            info($e);
        }
    }
}
