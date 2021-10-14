<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Cv;
use Illuminate\Support\Facades\Mail;
use App\Models\Job;

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
        $emailTemplate = $this->stepEmail;
        $job = Job::where('id',$this->job_id)->first();
        $company_name = $job->company->name;

        foreach($this->cv_id as $id ){
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
            Mail::send('emails.new.workflowstepemail', compact('emailTemplate','mail','company_name'), function ($m) use ($sendMail, $title) {
                $m->from(env('COMPANY_EMAIL'))->to($sendMail->email)->subject($title);
            });
        }
       
    }
}
