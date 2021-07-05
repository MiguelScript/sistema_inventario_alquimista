<?php

namespace Src\Users\Services;

use Src\Users\Repository\UserRepository;
use Src\Users\Object\User;
/* use Src\User\Object\ValueObjects\UserEmail;
use Src\User\Object\ValueObjects\UserName;
use Src\User\Object\ValueObjects\UserPassword; */

class CreateUserService
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $userName,
        $userLastName,
        $userEmail,
        $userPassword,
        $role
    ) {
       

        $user_container = new User($userName, $userLastName, $userEmail, $userPassword, $role);
        $user_array = $user_container->toArray();
        return $this->repository->create($user_array);
    }
}
