<?php

namespace Src\Sales\Services\GetSales;

use Src\Sales\Repository\SaleRepository;
use Src\Sales\Services\GetSales\Interfaces\IGetSales;

class GetSalesByStatusService implements IGetSales
{

    protected $repository;
    protected $status;

    public function __construct(SaleRepository $repository, $status)
    {
        $this->repository = $repository;
        $this->status = $status;
    }

    public function get_sales($offset, $limit)
    {
        $query = $this->repository->get_sales_by_offset_and_limit_and_status($offset, $limit, $this->status);
        return $query;
    }
    
    public function get_count()
    {
        $query = $this->repository->get_count_by_status($this->status);
        return $query;
    }
}
