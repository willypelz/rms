<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Maatwebsite\Excel\Excel;
use App\Models\Job;

class NotifyAdminOfFailedDownload extends Notification
{
    use Queueable;

    protected $admin,$type,$jobId;



    /**
     * Create a new notification instance.
     *
     * @param $type
     * @param $jobId
     * @param string $admin
     */
    public function __construct($admin, string $type, $jobId)
    {
        $this->admin = $admin; 
        $this->type = $type;
        $this->jobId = Job::find($jobId) ?? '';
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
       return (new MailMessage)
             ->subject(ucwords("{$this->jobId->title} {$this->type} export failed"))
             ->greeting('Hello '.$this->admin->name.'!')
             ->line("Your attempt to export {$this->type} failed. Please try again")
             ->line("We are sorry you had to experience this!")
             ->line('Thank you!');
            
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
            'link' => null,
            'title' => 'Applicant Spreedsheet Export for ' . $this->jobId->title . ' failed',
            'type' => 'export'
        ];
    }
}
