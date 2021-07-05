<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Users\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;


class UpdateUserController extends Controller
{
    /* public function __construct(CreateUserUseCase $create_user_use_case)
    {
        $this->create_user_use_case = $create_user_use_case;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $UpdatedUser = $this->create_user_use_case->__invoke($request);

        return response($UpdatedUser, 201);
    } */

    public function __invoke(Request $request)
    {
        $userId                = $request->input('id');
        $userName              = $request->input('name');
        $userLastName          = $request->input('last_name');
        $userEmail             = $request->input('email');
        $userPassword          = Hash::make($request->get('password'));
        $role                  = $request->input('role');

        $user_repository = new UserRepository();

        $data = array(
            'name' => $userName,
            'last_name' => $userLastName,
            'email' => $userEmail,
            'role_id' => $role,
        );

        if ($userPassword) {
            $data['password'] = $userPassword;
        }

        $user =  $user_repository->update($data, $userId);

        return response(['msg' => 'Se ha creado el usuario', 'data' => [ 'user_id' => $user]], 200);
    }
}
