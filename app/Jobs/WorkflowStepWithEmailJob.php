<?php

namespace App\Jobs;

use App\Models\Cv;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class WorkflowStepWithEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $cv_id, $stepEmail, $job_id;
    public function __construct(array $cv_id, $stepEmail,$job_id)
    {
        //
        $this->cv_id = $cv_id;
        $this->stepEmail = $stepEmail;
        $this->job_id = $job_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $title = "Update On Your Job Application";
        $job = Job::where('id',$this->job_id)->first();
        $company_name = $job->company->name;
        $client_id = $job->company->client_id;

        foreach($this->cv_id as $id ){
            $emailTemplate = $this->stepEmail;
            $sendMail = Cv::where('id',$id)->first();
            $mail = $sendMail->email;

            $transformables = [
                'applicant_name' => ucwords($sendMail->first_name),
                'job_title' => $job->title,
                'job_detail' => $job->detail,
                'company_name' => $company_name,
            ];
            foreach($transformables as $key => $transformable){
                $new = str_replace('{' . $key . '}', $transformable, $emailTemplate);
                $emailTemplate = $new;
            }
            
            Mail::send('emails.new.workflowstepemail', compact('emailTemplate','mail','company_name','client_id'), function ($m) use ($sendMail, $title, $client_id) {
                $m->from(getEnvData('COMPANY_EMAIL', null, $client_id))->to($sendMail->email)->subject($title);
            });
        }
       
    }
}
