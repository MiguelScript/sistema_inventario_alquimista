<?php

namespace Src\Sales\Handler;

use Src\Products\Services\ChangeStatusService;

class CancelSaleHandler
{

    protected $change_status_service;

    public function __construct(ChangeStatusService $change_status_service)
    {
       $this->change_status_service = $change_status_service;
    }

    public function __invoke($request)
    {

        $product_id = $request->input('id');
        $status = "cancel";

        $status_has_changed = $this->change_status_service->__invoke(
            $product_id, $status
        );

        if ($status_has_changed) {
            
        }

        return $this->setResponse($product_id);
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
