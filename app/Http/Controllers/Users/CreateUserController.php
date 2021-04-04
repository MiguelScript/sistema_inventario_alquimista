<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use Src\Users\UseCases\CreateUserUseCase;

class CreateUserController extends Controller
{
    public function __construct(CreateUserUseCase $create_user_use_case)
    {
        $this->create_user_use_case = $create_user_use_case;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $newUser = $this->create_user_use_case->__invoke($request);

        return response($newUser, 201);
    }
}
