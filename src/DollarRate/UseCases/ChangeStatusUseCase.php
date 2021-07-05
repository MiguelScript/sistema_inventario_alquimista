<?php

namespace Src\Sales\UseCases;

use Src\Sales\Services\ChangeStatusService;
use Src\Sales\Repository\ProductRepository;

class ChangeStatusUseCase
{

    protected $change_status_service;

    public function __construct(ChangeStatusService $change_status_service)
    {
        $this->change_status_service = $change_status_service;
    }

    public function __invoke($request, $status)
    {

        $product_id = $request->input('id');

        //$update_product_service = new ChangeStatusService($this->repository);
        $product_id = $this->change_status_service->__invoke(
            $product_id, $status
        );

        return $this->setResponse($product_id);
    }

    public function setResponse($query)
    {
        if ($query) {
            return [
                'data' => $query,
                'msg' => "se ha actualizado el producto exitosamente",
            ];
        } else {
            return [
                'data' => $query,
                'msg' => "Ha ocurrido un error al actualizar el producto",
            ];
        }
    }
}
