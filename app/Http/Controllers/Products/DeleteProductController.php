<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\DeleteProductRequest;
use Src\Products\UseCases\ChangeStatusUseCase;

class DeleteProductController extends Controller
{
    public function __construct(ChangeStatusUseCase $change_status_use_case)
    {
        $this->change_status_use_case = $change_status_use_case;
    }

    public function __invoke(DeleteProductRequest $request)
    {
        $status = "delete";
        $newproduct = $this->change_status_use_case->__invoke($request, $status);

        return response($newproduct, 201);
    }
}
