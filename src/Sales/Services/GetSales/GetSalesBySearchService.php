<?php

namespace Src\Sales\Services\GetSales;

use Src\Sales\Repository\SaleRepository;
use Src\Sales\Services\GetSales\Interfaces\IGetSales;

class GetSalesBySearchService implements IGetSales
{

    protected $repository;
    protected $search;

    public function __construct(SaleRepository $repository, $search)
    {
        $this->repository = $repository;
        $this->search = $search;
    }

    public function get_sales($offset, $limit)
    {
        $query = $this->repository->get_sales_by_offset_and_limit_and_search($offset, $limit, $this->search);
        return $query;
    }
    
    public function get_count()
    {
        $query = $this->repository->get_count_by_search($this->search);
        return $query;
    }
}
