<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\CreateUserRequest;
use Src\Users\UseCases\CreateUserUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\Users\Repository\UserRepository;

class CreateUserController extends Controller
{
    /* public function __construct(CreateUserUseCase $create_user_use_case)
    {
        $this->create_user_use_case = $create_user_use_case;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $query = $this->create_user_use_case->__invoke($request);

        return $query;

    } */

    public function make(CreateUserRequest $request)
    {

        $userName              = $request->input('name');
        $userLastName          = $request->input('last_name');
        $userEmail             = $request->input('email');
        $userPassword          = Hash::make($request->get('password'));
        $role                  = $request->input('role');

        $user_repository = new UserRepository();
        $already_exist = $user_repository->find_by_email($userEmail);
        if ($already_exist) {
            return response(['msg' => 'Este usuario ya existe'], 400);
        }

        $data = array(
            'name' => $userName,
            'last_name' => $userLastName,
            'email' => $userEmail,
            'password' => $userPassword,
            'role_id' => $role,
        );

        $user =  $user_repository->create($data);


        return response(['msg' => 'Se ha creado el usuario', 'data' => [ 'user_id' => $user]], 201);
    }
}
