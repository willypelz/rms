<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubsidiaryExpirationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $company_name, $company_email, $title, $user_name, $user_email, $client_id, $date;

    public function __construct($company_name,$company_email,$title,$user_name,$user_email,$client_id,$date) 
    {
        //
        $this->company_name = $company_name;
        $this->company_email = $company_email;
        $this->title = $title;
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->date = $date;
        $this->client_id = $client_id;
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
            'emails.subsidiary.expire-notify', ['subsidiary'=> $this->company_name, 'email_title' => $this->title, 
                'email'=> $this->company_email, 'user_name' => $this->user_name,
                'user_email'=> $this->user_email,'date' => $this->date,'client_id'=> $this->client_id]
        )
        ->from(getEnvData('COMPANY_EMAIL', null, $this->client_id))
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
