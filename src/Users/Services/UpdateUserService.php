<?php

namespace App\Services\Users;

use Src\Users\Repositories\UserRepository;

class UpdateUserService
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
    )
    {

        return $this->repository->update($dto, $dto['id']);
    }
}