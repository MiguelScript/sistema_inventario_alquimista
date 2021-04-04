<?php

namespace Src\Products\UseCases;

use Src\Products\Services\UpdateProductService;
use Src\Products\Repository\ProductRepository;

class UpdateProductUseCase
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {

        $product_id                 = $request->input('id');
        $product_name               = $request->input('nombre');
        $product_quantity           = $request->input('cantidad');
        $product_price_cost         = $request->input('precio_costo');
        $product_price_sale         = $request->input('precio_venta');
        $product_percentage_profit  = $request->input('porcentaje_ganancia');

        $update_product_service = new UpdateProductService($this->repository);
        $product_id = $update_product_service->__invoke(
            $product_id,
            $product_name,
            $product_quantity,
            $product_price_cost,
            $product_price_sale,
            $product_percentage_profit
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
