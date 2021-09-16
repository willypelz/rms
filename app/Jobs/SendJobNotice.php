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

    public $user;
    public $createdJobInfor;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $createdJobInfor)
    {
        $this->user = $user;
        $this->createdJobInfor = $createdJobInfor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(
            new JobCreatedNotice($this->user, $this->createdJobInfor)
        );
    }
}
