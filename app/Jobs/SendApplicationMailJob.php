<?php

namespace App\Jobs;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApplicationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidate,  $job_;
    public function __construct(int $candidateId, int $jobId)
    {
        $this->candidate = Candidate::with('client')->find($candidateId);
        $this->job_ = \App\Models\Job::find($jobId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clientId = $this->candidate->client;

        Mail::send('emails.new.job_application_successful', ['user' => $this->candidate, 'link' => route('candidate-dashboard'), 'job' => $this->job_], function (Message $m) use ($clientId) {
            $m->from(getEnvData('COMPANY_EMAIL', 'info@seamlesshr.com', $clientId))->to($this->candidate->email)->subject('Job Application Successful');
        });
    }
}
