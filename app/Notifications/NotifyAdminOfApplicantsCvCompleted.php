<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAdminOfApplicantsCvCompleted extends Notification
{
    use Queueable;

    protected $filename ;

    protected $link ;

    protected $disk ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($filename , $disk, $link)
    {
        $this->filename = $filename;
        $this->link = $link;
        $this->disk = $disk;
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
            "route" => !is_null($this->link) ? route( "download_applicants_interview_file", ["disk" => $this->disk ,"filename" => encrypt($this->link) ]) : null ,
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
          "link" => "",
          "title" => ""
      ];
    }
}
