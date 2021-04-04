<?php

namespace Src\Users\UseCases;

use Src\Users\Services\CreateUserService;
use Src\Users\Repositories\UserRepository;
use Src\Users\Object\User;

class CreateUserUseCase
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {
        $userName              = $request->input('name');
        $userEmail             = $request->input('email');
        $userPassword          = $request->input('password');

        $create_users_service = new CreateUserService($this->repository);
        $user_id = $create_users_service->__invoke(
            $userName,
            $userEmail,
            $userPassword
        );

        return $user_id;
    }
}
