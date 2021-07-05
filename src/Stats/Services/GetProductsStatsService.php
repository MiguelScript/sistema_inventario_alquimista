<?php

namespace Src\Stats\Services;

use Src\Products\Repository\ProductRepository;

class GetProductsStatsService 
{

    protected $repository;
    protected $month;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get_products_in_min_stock()
    {
        $query = $this->repository->get_products_in_min_stock();
        return $query;
    }
    
    public function get_count()
    {
        $query = $this->repository->get_count();
        return $query;
    }
}
