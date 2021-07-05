<?php

namespace Src\Sales\Handler;

use Src\Sales\Services\GetSales\GetSalesFactory;
use Src\Sales\Services\GetProductsSoldBySale;

class GetSalesHandler
{

    protected $get_sales;

    public function __construct(GetSalesFactory $get_sales, GetProductsSoldBySale $get_products)
    {
        $this->get_sales = $get_sales;
        $this->get_products = $get_products;
    }

    public function __invoke($request)
    {

        $offset = $request->input('offset');
        $limit  = $request->input('limit');
        $search = $request->input('search');
        $status = $request->input('status');

        //var_dump($request->input('status'));

        $get_sales_obj = $this->get_sales->__invoke($search, $status);

        $sales = $get_sales_obj->get_sales_by_filter($offset, $limit);
        $count_sales = $get_sales_obj->count_sales_by_filter();

        foreach ($sales as $key => $sale) {
            $sale->products =  $this->get_products->__invoke($sale->id);              
        }
       
        return $this->setResponse($sales, $count_sales);
    }

    public function setResponse($ventas, $total_ventas)
    {
        if (count($ventas) > 0) {
            return [
                'data' => array(
                    'ventas' => $ventas,
                    'total_ventas' => $total_ventas
                ),
                'msg' => "Se ha encontrado ventas",
            ];
        } else {
            return [
                'data' => array(
                    'ventas' => $ventas,
                    'total_ventas' => $total_ventas
                ),
                'msg' => "Oh no, no se han encontrado ventas",
            ];
        }
    }
}
