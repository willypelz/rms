<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\JobCreatedNotice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendJobNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $employees;
    public $createdJobInfor;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($employees, $createdJobInfor)
    {
        $this->employees = $employees;
        $this->createdJobInfor = $createdJobInfor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->employees as $employee) {
            Mail::to($employee->email)->send(
                new JobCreatedNotice($employee, $this->createdJobInfor)
            );
        }
    }
}
