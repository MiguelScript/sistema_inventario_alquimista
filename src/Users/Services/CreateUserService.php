<?php

namespace Src\Users\Services;

use Src\Users\Repositories\UserRepository;
use Src\User\Object\User;
use Src\User\Object\ValueObjects\UserEmail;
use Src\User\Object\ValueObjects\UserName;
use Src\User\Object\ValueObjects\UserPassword;

class CreateUserService
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $userName,
        $userEmail,
        $userPassword
    ) {
       

        $user_container = new User($userName, $userEmail, $userPassword);
        $user = $user_container->create();

        return $this->repository->create($user);
    }
}
