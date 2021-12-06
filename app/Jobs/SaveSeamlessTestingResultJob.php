<?php

namespace App\Jobs;

use Curl;
use App\Models\TestRequest;
use Illuminate\Bus\Queueable;
use App\Models\JobApplication;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SeamlessHR\SolrPackage\Facades\SolrPackage;


class SaveSeamlessTestingResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $request;
    public function __construct($request)
    {
        $this->request = (object) $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        try{
            $app = JobApplication::with('job')->where('id', $request->job_application_id)->first();

                save_activities('TEST_RESULT', @$app->job->id, $request->job_application_id);

                TestRequest::where('job_application_id', $request->job_application_id)
                    ->where('test_id', $request->test_id)
                    ->update([
                        'actual_start_time' => $request->actual_start_time,
                        'actual_end_time' => $request->actual_end_time,
                        'score' => $request->score,
                        'result_comment' => @$request->result_comment,
                        'status' => @$request->status
                    ]);
                SolrPackage::update_core();
        }catch(\Exception $e){
            info($e);
        }
    }
    
}
