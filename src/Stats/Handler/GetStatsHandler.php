<?php

namespace Src\Stats\Handler;

use Src\Stats\UseCases\GetProductsStatsUseCase;
use Src\Stats\UseCases\GetSalesStatsUseCase;

class GetStatsHandler
{

    protected $get_sales_stats;
    protected $get_products_stats;

    public function __construct(GetSalesStatsUseCase $get_sales_stats, GetProductsStatsUseCase $get_products_stats)
    {
        $this->get_sales_stats = $get_sales_stats;
        $this->get_products_stats = $get_products_stats;
    }

    public function __invoke($request)
    {

        //$offset = $request->input('offset');
        $month  = $request->input('month');


        //var_dump($request->input('status'));

        $sales_stats = $this->get_sales_stats->__invoke($month);
        $products_stats = $this->get_products_stats->__invoke($month);

        /* $sales = $get_sales_obj->get_sales_by_filter($offset, $limit);
        $count_sales = $get_sales_obj->count_sales_by_filter(); */

        return json_encode($this->setResponse($sales_stats, $products_stats)); 
    }

    public function setResponse($sales_stats, $products_stats)
    {
        //if (count($ventas) > 0) {
            return [
                'data' => array(
                    'ventas' => $sales_stats,
                    'productos' => $products_stats
                ),
                'msg' => "Se ha encontrado ventas",
            ];
       /*  } else {
            return [
                'data' => array(
                    'ventas' => $ventas,
                    'total_ventas' => $total_ventas
                ),
                'msg' => "Oh no, no se han encontrado ventas",
            ];
        } */
    }
}
