<?php

namespace Src\Products\UseCases;

use Src\Products\Services\CreateProductService;
use Src\Products\Services\CreateProductCodeService;
use Src\Products\Repository\ProductRepository;

class CreateProductUseCase
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {

        $product_name               = $request->input('nombre');
        $product_quantity           = $request->input('cantidad');
        $product_price_cost         = $request->input('precio_costo');
        $product_price_sale         = $request->input('precio_venta');
        $product_percentage_profit  = $request->input('porcentaje_ganancia');

        $create_products_service = new CreateProductService($this->repository);
        $product_id = $create_products_service->__invoke(
            $product_name,
            $product_quantity,
            $product_price_cost,
            $product_price_sale,
            $product_percentage_profit,
        );

        $create_product_code_service = new CreateProductCodeService($this->repository);
        $codigo = $create_product_code_service->__invoke($product_id);

        return $this->setResponse($product_id);
    }

    public function setResponse($query)
    {
        if ($query) {
            return [
                'data' => $query,
                'msg' => "se ha creado el producto exitosamente",
            ];
        } else {
            return [
                'data' => $query,
                'msg' => "Ha ocurrido un error al crear el producto",
            ];
        }
    }
}
