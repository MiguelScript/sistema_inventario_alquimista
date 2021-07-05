<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Src\Users\UseCases\GetUsersUseCase;

use Illuminate\Http\Request;


class GetUsersController extends Controller
{
    public function __construct(GetUsersUseCase $get_users_use_case)
    {
        $this->get_products_use_case = $get_users_use_case;
    }

    public function __invoke(Request $request)
    {
        $newproduct = $this->get_products_use_case->__invoke($request);

        return response($newproduct, 200);
    }
}
