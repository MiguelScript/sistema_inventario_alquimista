<?php

namespace Src\Sales\Services;

use Src\Sales\Repository\SaleRepository;

class GetProductsSoldBySale
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($sale_id)
    {
        return $this->repository->get_products_from_sale($sale_id);
    }
}