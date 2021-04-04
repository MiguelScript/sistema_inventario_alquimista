<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use Src\Products\UseCases\CreateProductUseCase;

class CreateProductController extends Controller
{
    public function __construct(CreateProductUseCase $create_product_use_case)
    {
        $this->create_product_use_case = $create_product_use_case;
    }

    public function __invoke(CreateProductRequest $request)
    {
        $newproduct = $this->create_product_use_case->__invoke($request);

        return response($newproduct, 201);
    }
}
