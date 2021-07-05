<?php

namespace App\Http\Controllers\DollarRate;

use App\Http\Controllers\Controller;
use Src\DollarRate\Handler\GetDollarRateHandler;
use Illuminate\Http\Request;

class GetDollarRateController extends Controller
{
    public function __construct(GetDollarRateHandler $get_dollar_rate_handler)
    {
        $this->get_dollar_rate_handler = $get_dollar_rate_handler;
    }

    public function __invoke(Request $request)
    {
        $newSale = $this->get_dollar_rate_handler->__invoke($request);

        return response($newSale, 200);
    }
}