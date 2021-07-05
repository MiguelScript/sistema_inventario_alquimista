<?php

namespace Src\Stats\UseCases;

use Src\Stats\Services\GetSalesStatsService;

class GetSalesStatsUseCase
{

    protected $get_sales_service;

    public function __construct(GetSalesStatsService $get_sales_service)
    {
        $this->get_sales_service = $get_sales_service;
    }

    public function __invoke($month)
    {
        $get_last_sales = $this->get_sales_service->get_last_sales();
        $stats_by_moth = $this->get_sales_service->get_productos_vendidos_and_monto_total_ventas($month);
        //$get_last_sales = $this->get_sales_service->get_sales();
        $data = array(
            'last_sales' => $get_last_sales, 
            'stats_by_moth' => $stats_by_moth, 
        );
        return $data;
    }

    public function setResponse($query)
    {
       // if ($query['productos']) {
            return [
                'data' => $query,
                'msg' => "se han encontrado productos",
            ];
        /* } else {
            return [
                'data' => $query,
                'msg' => "Oh no, no se han encontrado productos",
            ];
        } */
    }
}
