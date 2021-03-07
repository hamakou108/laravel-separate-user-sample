<?php

namespace App\Models;

use Domain\User\UserId;
use Domain\User\UserNotifier;
use Domain\User\UserRepository;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class User implements
    Authenticatable,
    AuthorizableContract,
    CanResetPassword,
    MustVerifyEmail
{
    use Authorizable;

    private UserId $id;
    private UserRepository $repository;
    private UserNotifier $notifier;

    public function __construct(
        UserId $id,
        UserRepository $repository,
        UserNotifier $notifier
    ) {
        $this->id = $id;
        $this->repository = $repository;
        $this->notifier = $notifier;
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifier()
    {
        return $this->id->rawValue();
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->repository->getPassword($this->id)->rawValue();
    }

    /**
     * @inheritDoc
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function setRememberToken($value)
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * @inheritDoc
     */
    public function getEmailForPasswordReset()
    {
        return $this->repository->getEmail($this->id)->rawValue();
    }

    /**
     * @inheritDoc
     */
    public function sendPasswordResetNotification($token)
    {
        // TODO: パスワードリセット機能を使う場合は Notifier を拡張する
        return;
    }

    /**
     * @inheritDoc
     */
    public function hasVerifiedEmail()
    {
        return $this->repository->hasVerifiedEmail($this->id);
    }

    /**
     * @inheritDoc
     */
    public function markEmailAsVerified()
    {
        return $this->repository->markEmailAsVerified($this->id);
    }

    /**
     * @inheritDoc
     */
    public function sendEmailVerificationNotification()
    {
        $user = $this->repository->get($this->id);
        $url = $this->createVerificationUrl();

        $this->notifier->sendEmailVerificationNotification($user, $url);
    }

    /**
     * @inheritDoc
     */
    public function getEmailForVerification()
    {
        return $this->repository->getEmail($this->id)->rawValue();
    }

    private function createVerificationUrl(): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $this->id->rawValue(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );
    }
}
