<?php


namespace Infra\Notifiable;


use Domain\User\User as DomainUser;
use Illuminate\Notifications\Notifiable;

class User
{
    use Notifiable;

    private DomainUser $user;

    public function __construct(DomainUser $user)
    {
        $this->user = $user;
    }

    public function routeNotificationForMail()
    {
        return $this->user->getRawEmail();
    }
}
