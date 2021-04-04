<?php

namespace Src\Sales\Handler;

use Src\Sales\Services\GetSalesFactory;

class GetSalesHandler
{

    protected $change_status_service;

    public function __construct(GetSalesFactory $change_status_service)
    {
       $this->change_status_service = $change_status_service;
    }

    public function __invoke($request)
    {

        $offset = $request->input('offset');
        $limit  = $request->input('limit');
        $search = $request->input('search');
        $status = $request->input('status');

        $get_sales_obj = $this->change_status_service->__invoke($search, $status);

        $sales = $get_sales_obj->get_sales_by_filter($offset, $limit);
        $count_sales = $get_sales_obj->count_sales_by_filter();

        return $this->setResponse($sales, $count_sales);
    }

    public function setResponse($ventas, $total_ventas)
    {
        if (count($ventas) > 0) {
            return response([
                'data' => array(
                    'ventas' => $ventas,
                    'total_ventas' => $total_ventas
                ),
                'msg' => "Se ha encontrado ventas",
            ], 200);
        } else {
            return response([
                'data' => array(
                    'ventas' => $ventas,
                    'total_ventas' => $total_ventas
                ),
                'msg' => "Oh no, no se han encontrado ventas",
            ], 200);
        }
    }
}