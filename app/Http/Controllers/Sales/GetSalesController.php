<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Src\Sales\Handler\GetSalesHandler;
use Illuminate\Http\Request;

class GetSalesController extends Controller
{
    public function __construct(GetSalesHandler $get_sales_handler)
    {
        $this->get_sales_handler = $get_sales_handler;
    }

    public function __invoke(Request $request)
    {
        $newSale = $this->get_sales_handler->__invoke($request);

        return response($newSale, 201);
    }
}