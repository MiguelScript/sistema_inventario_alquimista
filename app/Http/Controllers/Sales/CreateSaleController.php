<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\CreateSaleRequest;
use Src\Sales\Handler\CreateSaleHandler;

class CreateSaleController extends Controller
{
    public function __construct(CreateSaleHandler $create_sale_handler)
    {
        $this->create_sale_handler = $create_sale_handler;
    }

    public function __invoke($request)
    {
        $newSale = $this->create_sale_handler->__invoke($request);

        return response($newSale, 201);
    }
}
