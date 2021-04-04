<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\UpdateProductRequest;
use Src\Products\UseCases\UpdateProductUseCase;

class UpdateProductController extends Controller
{
    public function __construct(UpdateProductUseCase $create_product_use_case)
    {
        $this->create_product_use_case = $create_product_use_case;
    }

    public function __invoke(UpdateProductRequest $request)
    {
        $newproduct = $this->create_product_use_case->__invoke($request);

        return response($newproduct, 201);
    }
}
