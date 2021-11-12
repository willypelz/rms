<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Maatwebsite\Excel\Excel;
use App\Models\Job;

class NotifyAdminOfApplicantsSpreedsheetExportCompleted extends Notification
{
    use Queueable;

    protected $filename,$type,$job,$admin;



    /**
     * Create a new notification instance.
     *
     * @param $type
     * @param $job
     * @param string $filename
     */
    public function __construct(string  $filename, string $type, $jobId, $admin)
    {
        $this->filename = $filename; 
        $this->admin = $admin;
        $this->type = $type;
        $this->job = Job::find($jobId) ?? '';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = [
            "filename" => $this->job->title,
            "name" => $notifiable->name,
            "route" => companyRoute($this->admin->client_id, "download_applicants_interview_file", ["filename" => encrypt($this->filename) ])
        ];
        return (new MailMessage())
             ->subject(ucwords("{$this->job->title} {$this->type} export completed"))
             ->view("emails.new.applicant_interview_downloads", $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'link' => $this->link,
            'title' => 'Applicant Spreedsheet Export for ' . $this->filename . ' is Ready',
            'type' => 'export'
        ];
    }
}
