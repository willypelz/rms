<?php

namespace App\Observers;

use App\User;
use App\Models\Job;
use App\Models\Company;
use App\Jobs\SendJobNotice;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as HttpClient;

class JobObserver
{
    /**
     * Handle the job "created" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created Job',
                'description' => 'Created a Job'.' '.$job->title,
                'action_id' => $job->id,
                'action_type' => 'App\Models\Job',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];
            logAction($param);            
        }
        if (isHrmsIntegrated()) {
            $company = Company::where('id', $job->company_id)->first();
            if ($job->is_for == 'both' || $job->is_for == 'internal') {
                $sendJob = [
                    'title' => $job->title,
                    'summary' => $job->summary,
                    'expiry_date' => $job->expiry_date,
                    'position' => $job->position,
                    'hrms_id' => $company->hrms_id
                ];
                $response = Curl::to(config('app.staff_strength_url') . 'api/v1/send/notification')
                    ->withData($sendJob)
                    ->asJson()
                    ->get();
                Log::info($response);
            }
        } else {
            if ($job->is_for == 'both' || $job->is_for == 'internal') {
                $employees = User::where('activated', 1)->get();
                dispatch(new SendJobNotice($employees, $job));
            }
        }

        
    }

    /**
     * Handle the job "updated" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        //
        if(auth()->check()){
            $old = $job->getOriginal('title');
            if($job->isDirty('title')){
                $param = [
                    'log_name' => 'Updated Job',
                    'description' => 'Updated Job '.$old.' to '.$job->title,
                    'action_id' => $job->id,
                    'action_type' => 'App\Models\Job',
                    'causee_id' => auth()->user()->id,
                    'causer_id' => auth()->user()->id,
                    'causer_type' => 'Admin',
                    'properties' => '',
                ];
            }else{
                $param = [
                    'log_name' => 'Updated Job',
                    'description' => 'Updated Job '.$job->title,
                    'action_id' => $job->id,
                    'action_type' => 'App\Models\Job',
                    'causee_id' => auth()->user()->id,
                    'causer_id' => auth()->user()->id,
                    'causer_type' => 'Admin',
                    'properties' => '',
                ];
            }
            

            logAction($param);
           
        }
    }

    /**
     * Handle the job "deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a Job',
                'description' => 'Deleted a Job',
                'action_id' => $job->id,
                'action_type' => 'App\Models\Job',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'Admin',
                'properties' => '',
            ];

            logAction($param);
           
        }
    }

    /**
     * Handle the job "restored" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function restored(Job $job)
    {
        //
    }

    /**
     * Handle the job "force deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
    }
}
