<?php

namespace Src\Products\Services;

use Src\Products\Repository\ProductRepository;
use Src\Products\Object\Product;

class UpdateProductService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $product_id,
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

        $query = $this->repository->update($user, $product_id);
        return $query;
    }
}
