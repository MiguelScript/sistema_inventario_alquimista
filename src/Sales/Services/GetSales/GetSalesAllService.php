<?php

namespace Src\Sales\Services\GetSales;

use Src\Sales\Repository\SaleRepository;
use Src\Sales\Services\GetSales\Interfaces\IGetSales;

class GetSalesAllService implements IGetSales
{

    protected $repository;
    protected $status;
    protected $search;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get_sales($offset, $limit)
    {
        $query = $this->repository->get_sales_by_offset_and_limit($offset, $limit);
        return $query;
    }
    
    public function get_count()
    {
        $query = $this->repository->get_count();
        return $query;
    }
}
