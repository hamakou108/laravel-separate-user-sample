<?php


namespace Infra\Notifier\Illuminate;

use Domain\User\User;
use Domain\User\UserNotifier as UserNotifierInterface;
use Illuminate\Contracts\Notifications\Dispatcher;
use Infra\Notifiable\User as NotifiableUser;
use Infra\Notifications\VerifyEmail;

class UserNotifier implements UserNotifierInterface
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function sendEmailVerificationNotification(User $user, string $url): void
    {
        $this->dispatcher->send(new NotifiableUser($user), new VerifyEmail($url));
    }
}
