<?php

namespace Src\Products\Services;

use Exception;
use Src\Products\Repository\ProductRepository;


class UpdateMultipleProductsService
{
    private $repository;


    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($products)
    {
        $query = $this->repository->update_batch($products);

        if ($query) {
            return $query;
        } else {
            throw new Exception("No se actualizo la cantidad disponible de los productos", 1);
        }
    }
}