<?php

namespace App\Console\Commands;

use App\Models\TestRequest;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;

class ResyncTestScoreFromSeamlessTesting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resync:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resync test scores from SeamlessTesting For Canidates that have completed the test';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
        $webhook_url = env('SEAMLESS_TESTING_APP_URL').'/sync/test-result';
        $test_requests =  TestRequest::select(['id','job_application_id','test_id','start_time','end_time'])->whereStatus('PENDING')
        ->chunk(100, function ($test_requests) use($webhook_url) {
            foreach($test_requests as $test){
                $data =[
                    'job_application_id'=>$test->job_application_id,
                    'test_id'=>$test->test_id,
                    'start_time'=>$test->start_time,
                    'end_time'=>$test->end_time,
                ];
               
               $response =  Curl::to($webhook_url)->withData($data)->asJson()->get();
               if($response->status == 200 && $response->data != null){
                   $val = $response->data;
                   
                $test->update([
                    'actual_start_time'=>$val->actual_start_time,
                    'actual_end_time'=>$val->actual_end_time,
                    'score'=>$val->score,
                    'percentage'=>$val->percentage,
                    'status'=>$val->completed == 1 ? 'COMPLETED' : $test->status
                    ]);
               }
            }

        });
        dump('done');
        }catch(\Exception $e){
            dump($e);
        }
    
    }
}
