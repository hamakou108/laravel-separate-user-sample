<?php


namespace Domain\User;


interface UserNotifier
{
    public function sendEmailVerificationNotification(User $user, string $url): void;
}
