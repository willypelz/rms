<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        // $this->mailer->raw($message, function (Message $m) use ($user) {
        //     $m->to($user->email)->subject('Activation mail');
        // });
        Mail::send('emails.new.activate_account', ['user' => $user, 'link' => $link], function (Message $m) use ($user) {
            $m->from('support@seamlesshiring.com')->to($user->email)->subject('Activate your Seamlesshiring account');
        });
        // Mail::send('emails.cv-sales.invoice', [], function($message){
        //     $message->from(env('COMPANY_EMAIL'));
        //     $message->to('babatopeoni@gmail.com', 'SH test email');
        // }); 


    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        Mail::send('emails.new.onboarding.successfully_activated', ['user' => $user], function (Message $m) use ($user) {
            $m->from('support@seamlesshiring.com')->to($user->email)->subject('Your Account has been Successfully Activated!');
        });
        
        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}
