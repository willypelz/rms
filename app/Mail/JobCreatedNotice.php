<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobCreatedNotice extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $user;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $job)
    {
        $this->data = $job;
        $this->user = $user;
        $this->url = getEnvData('STAFFSTRENGTH_URL',null,request()->clientId).'/internal-recruitment/recruitment/jobs';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Job position Opening')
                    ->markdown('emails.job-notice');
    }
}
