<?php


namespace Infra\Repository\Eloquent;

use Domain\User\User;
use Domain\User\UserEmail;
use Domain\User\UserId;
use Domain\User\UserName;
use Domain\User\UserPassword;
use Domain\User\UserRepository as UserRepositoryInterface;
use Illuminate\Support\Facades\Date;
use Infra\Model\Eloquent\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    public function hasVerifiedEmail(UserId $id): bool
    {
        return ! is_null($this->getUserModel($id)->email_verified_at);
    }

    public function get(UserId $id): User
    {
        return $this->getUserModel($id)->toDomain();
    }

    public function getEmail(UserId $id): UserEmail
    {
        return new UserEmail($this->getUserModel($id)->email);
    }

    public function getPassword(UserId $id): UserPassword
    {
        return new UserPassword($this->getUserModel($id)->password);
    }

    public function getIdByEmail(UserEmail $email): UserId
    {
        return new UserId($this->getUserModelByEmail($email)->id);
    }

    public function create(UserName $name, UserEmail $email, UserPassword $password): UserId
    {
        $model = new UserModel();

        $model->name = $name->rawValue();
        $model->email = $email->rawValue();
        $model->password = $password->rawValue();

        $model->save();

        return new UserId($model->id);
    }

    public function markEmailAsVerified(UserId $id): bool
    {
        return UserModel::where('id', $id->rawValue())
            ->whereNull('email_verified_at')
            ->update([
                'email_verified_at' => Date::now(),
            ]);
    }

    private function getUserModel(UserId $id): UserModel
    {
        return UserModel::where('id', $id->rawValue())->first();
    }

    private function getUserModelByEmail(UserEmail $email): UserModel
    {
        return UserModel::where('email', $email->rawValue())->first();
    }
}
