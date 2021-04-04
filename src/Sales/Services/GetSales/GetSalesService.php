<?php

namespace Src\Sales\Services;

use Src\Sales\Services\GetSales\Interfaces\IGetSales;
use Src\Sales\Services\GetSales\Interfaces\IGetSalesCount;


class GetSalesService
{

    protected $get_sales;
    protected $get_sales_count;

    public function __construct(IGetSales $get_sales /* ,IGetSalesCount $get_sales_count */)
    {
        //$this->repository = $repository;
        $this->get_sales = $get_sales;
        //$this->get_sales_count = $get_sales_count;
    }

    public function get_sales_by_filter($offset, $limit)
    {
        
        return $this->get_sales->get_sales($offset, $limit);
    }

    public function count_sales_by_filter()
    {
        return $this->get_sales->get_count();
    }

    
}
