<?php

namespace App\Providers;

use Domain\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use Infra\Repository\Eloquent\UserRepository as EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }
}
