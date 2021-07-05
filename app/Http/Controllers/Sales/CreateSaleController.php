<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Src\Sales\Handler\CreateSaleHandler;
use Illuminate\Http\Request;
class CreateSaleController extends Controller
{
    public function __construct(CreateSaleHandler $create_sale_handler)
    {
        $this->create_sale_handler = $create_sale_handler;
    }

    public function __invoke(Request $request)
    {
        $newSale = $this->create_sale_handler->__invoke($request);

        return response($newSale, 201);
    }
}
