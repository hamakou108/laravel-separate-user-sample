<?php


namespace App\Providers;


use Domain\User\UserNotifier;
use Illuminate\Support\ServiceProvider;
use Infra\Notifier\Illuminate\UserNotifier as IlluminateUserNotifier;

class NotifierServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserNotifier::class, IlluminateUserNotifier::class);
    }
}
