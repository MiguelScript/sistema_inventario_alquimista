<?php

namespace Src\Products\UseCases;

use Src\Products\Services\ChangeStatusService;
use Src\Products\Repository\ProductRepository;

class ChangeStatusUseCase
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request, $status)
    {

        $product_id = $request->input('id');

        $update_product_service = new ChangeStatusService($this->repository);
        $product_id = $update_product_service->__invoke(
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
