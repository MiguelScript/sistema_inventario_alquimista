<?php

namespace Src\Sales\Handler;

use Src\Sales\Services\CreateSaleService;

class CreateSaleHandler
{

    protected $change_status_service;

    public function __construct(CreateSaleService $create_sale_service)
    {
       $this->create_sale_service = $create_sale_service;
    }

    public function __invoke($request)
    {
        $sale_amount    = $request->input('monto');
        $products    = json_decode($request->input('products'));

        $sale_id = $this->create_sale_service->__invoke(
            $sale_amount, $products
        );

        return $this->setResponse($sale_id);
    }

    public function setResponse($query)
    {
        if ($query) {
            return [
                'data' => $query,
                'msg' => "se ha anulado la venta exitosamente",
            ];
        } else {
            return [
                'data' => $query,
                'msg' => "Ha ocurrido un error al anulado la venta",
            ];
        }
    }
}
