<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Src\Products\UseCases\GetProductsUseCase;

use Illuminate\Http\Request;


class GetProductsController extends Controller
{
    public function __construct(GetProductsUseCase $get_products_use_case)
    {
        $this->get_products_use_case = $get_products_use_case;
    }

    public function __invoke(Request $request)
    {
        $newproduct = $this->get_products_use_case->__invoke($request);

        return response($newproduct, 201);
    }
}
