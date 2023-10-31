<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verification_code = rand(100000,999999);
        $notifiable->verification_code = $verification_code;
        $notifiable->save();

        $array['subject'] = translate('Email Verification'); 
        $array['content'] = translate('You verification code is ');
        $array['verification_code'] = $verification_code;
 
        return (new MailMessage)
            ->view('emails.verification', ['array' => $array])
            ->subject(translate('Email Verification').' - '.env('APP_NAME'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
