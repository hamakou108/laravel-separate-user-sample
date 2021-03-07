<?php


namespace Infra\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as IlluminateVerifyEmail;

class VerifyEmail extends IlluminateVerifyEmail
{
    private string $verificationUrl;

    public function __construct(string $verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($this->verificationUrl);
    }
}
