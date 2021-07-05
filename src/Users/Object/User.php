<?php

declare(strict_types=1);

namespace Src\Users\Object;

final class User
{
    private $name;
    private $last_name;
    private $email;
    private $password;
    private $role;

    public function __construct(
        $name,
        $last_name,
        $email,
        $password,
        $role
    ) {
        $this->name         =   $name;
        $this->last_name    =   $last_name;
        $this->email        =   $email;
        $this->password     =   $password;
        $this->role         =   $role;
    }

    public function name()
    {
        return $this->name;
    }

    public function last_name()
    {
        return $this->last_name;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function role()
    {
        return $this->role;
    }


    public function create(): User
    {
        $user = new self($this->name, $this->last_name, $this->email,  $this->password, $this->role);

        return $user;
    }

    public function toArray(): array
    {
        return array(
            'name' => $this->name, 
            'last_name' => $this->last_name, 
            'email' => $this->email, 
            'password' => $this->password, 
            'role_id' => $this->role, 
        );
    }
}
