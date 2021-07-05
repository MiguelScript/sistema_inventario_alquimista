<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Src\Sales\Handler\CancelSaleHandler;
use Illuminate\Http\Request;

class CancelSaleController extends Controller
{
    public function __construct(CancelSaleHandler $cancel_sale_use_case)
    {
        $this->cancel_sale_use_case = $cancel_sale_use_case;
    }

    public function __invoke(Request $request)
    {
        $newSale = $this->cancel_sale_use_case->__invoke($request);

        return response($newSale, 201);
    }
}
