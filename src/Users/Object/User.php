<?php

declare(strict_types=1);

namespace Src\User\Object;

final class User
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        $name,
        $email,
        $password
    ) {
        $this->name     =   $name;
        $this->email    =   $email;
        $this->password =   $password;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function create(): User
    {
        $user = new self($this->name, $this->email,  $this->password);

        return $user;
    }
}
