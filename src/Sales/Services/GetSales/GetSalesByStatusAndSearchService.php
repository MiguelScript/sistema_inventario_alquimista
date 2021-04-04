<?php

namespace Src\Sales\Services\GetSales;

use Src\Sales\Repository\SaleRepository;
use Src\Sales\Services\GetSales\Interfaces\IGetSales;

class GetSalesByStatusAndSearchService implements IGetSales
{

    protected $repository;
    protected $status;
    protected $search;

    public function __construct(SaleRepository $repository, $status, $search)
    {
        $this->repository = $repository;
        $this->status = $status;
        $this->search = $search;
    }

    public function get_sales($offset, $limit)
    {
        $query = $this->repository->get_sales_by_offset_and_limit_and_status_and_search($offset, $limit, $this->status, $this->search);
        return $query;
    }
    
    public function get_count()
    {
        $query = $this->repository->get_count_by_status_and_search($this->status, $this->search);
        return $query;
    }
}
