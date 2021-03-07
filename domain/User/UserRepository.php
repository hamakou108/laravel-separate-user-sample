<?php


namespace Domain\User;


interface UserRepository
{
    public function hasVerifiedEmail(UserId $id): bool;

    public function get(UserId $id): User;

    public function getEmail(UserId $id): UserEmail;

    public function getPassword(UserId $id): UserPassword;

    public function getIdByEmail(UserEmail $email): UserId;

    public function create(UserName $name, UserEmail $email, UserPassword $password): UserId;

    public function markEmailAsVerified(UserId $id): bool;
}
