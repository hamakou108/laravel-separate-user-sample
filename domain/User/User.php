<?php


namespace Domain\User;


class User
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;

    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getRawId(): int
    {
        return $this->id->rawValue();
    }

    public function getRawEmail(): string
    {
        return $this->email->rawValue();
    }
}
