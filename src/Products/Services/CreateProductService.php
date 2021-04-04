<?php

namespace Src\Products\Services;

use Src\Products\Repository\ProductRepository;
use Src\Products\Object\Product;

class CreateProductService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $product_name,
        $product_quantity,
        $product_price_cost,
        $product_price_sale,
        $product_percentage_profit
    ) {
        $user_container = new Product(
            $product_name,
            $product_quantity,
            $product_price_cost,
            $product_price_sale,
            $product_percentage_profit,
        );
        $user = $user_container->create();

        return $this->repository->create($user);
    }

    public function setResponse($query)
    {
        if ($query) {
            return response([
                'data' => $query,
                'msg' => "se ha creado el usuario exitosamente",
            ], 200);
        } else {
            return response([
                'data' => $query,
                'msg' => "Ha ocurrido un error al crear el usuario",
            ], 400);
        }
    }
}
