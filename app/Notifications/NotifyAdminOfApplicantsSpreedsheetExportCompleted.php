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

    protected $excel_file,$filename, $disk, $link ;



    /**
     * Create a new notification instance.
     *
     * @param $excel_file
     * @param string $filename
     * @param string $disk
     * @param string $link
     */
    public function __construct($excel_file, string  $filename, string $disk,  string $link )
    {
        $this->filename = $filename;
        $this->excel_file = $excel_file;
        $this->disk = $disk;
        $this->link = $link;
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
            "route" => route( "download_applicants_interview_file", ["disk" => $this->disk ,"filename" => encrypt($this->link) ])
        ];
        return (new MailMessage())
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
