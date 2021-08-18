<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Maatwebsite\Excel\Excel;

class NotifyAdminOfApplicantsSpreedsheetExportCompleted extends Notification
{
    use Queueable;

    protected $filename;



    /**
     * Create a new notification instance.
     *
     * @param $excel_file
     * @param string $filename
     * @param string $disk
     * @param string $link
     */
    public function __construct(string  $filename)
    {
        $this->filename = $filename;
        session()->forget('exportCompleted');
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
            "filename" => $this->filename,
            "name" => $notifiable->name,
            "route" => route( "download_applicants_interview_file", ["disk" => 'public' ,"filename" => encrypt(asset('uploads/tmp/').$this->filename) ])
        ];
        return (new MailMessage())
             ->subject('Applicant spreadsheet export completed')
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
