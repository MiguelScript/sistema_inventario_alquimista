<?php

namespace Src\Users\Services;

use Src\Users\Repository\UserRepository;


class FindUserByEmail
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($email)
    {
        return $this->repository->find_by_email($email);
    }
}
