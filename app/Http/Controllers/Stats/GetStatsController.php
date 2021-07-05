<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use Src\Stats\Handler\GetStatsHandler;
use Illuminate\Http\Request;

class GetStatsController extends Controller
{
    public function __construct(GetStatsHandler $get_stats_handler)
    {
        $this->get_stats_handler = $get_stats_handler;
    }

    public function __invoke(Request $request)
    {
        $newSale = $this->get_stats_handler->__invoke($request);

        return response($newSale, 200);
    }
}