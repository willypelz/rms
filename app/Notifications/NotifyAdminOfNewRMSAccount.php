<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyAdminOfNewRMSAccount extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $company, $title, $user_email, $user_name;

    public function __construct($company,$user)
    { 
        $this->company = $company;
        $this->title = 'Your SeamlessHiring Account is ready';
        $this->user_email = $user->email;
        $this->user_name = $user->name;
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
        return (new MailMessage)->view(
            'emails.self-sign-up.new-account-notify',['notifiable'=> $notifiable, 'email_title' => $this->title, 
            'email'=> $this->company->email,'user_email'=> $this->user_email,'user_name'=>$this->user_name]
        )
        ->from('support@seamlesshr.com')
        ->subject($this->title);
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
            //
        ];
    }
}
