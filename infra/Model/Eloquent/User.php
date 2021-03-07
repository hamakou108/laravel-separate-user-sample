<?php


namespace Infra\Model\Eloquent;

use Domain\User\User as DomainUser;
use Domain\User\UserEmail;
use Domain\User\UserId;
use Domain\User\UserName;
use Domain\User\UserPassword;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function toDomain(): DomainUser
    {
        return new DomainUser(
            new UserId($this->id),
            new UserName($this->name),
            new UserEmail($this->email),
            new UserPassword($this->password)
        );
    }
}
