<?php

namespace Src\Products\Services;

use Src\Products\Repository\ProductRepository;

class CreateProductCodeService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($product_id)
    {
        $data = array('codigo' => "REP" . $product_id,);

        return $this->repository->update($data, $product_id);
    }
}