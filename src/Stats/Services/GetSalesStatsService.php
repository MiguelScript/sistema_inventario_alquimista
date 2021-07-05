<?php

namespace Src\Stats\Services;

use Src\Sales\Repository\SaleRepository;

class GetSalesStatsService 
{

    protected $repository;
    protected $month;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get_last_sales()
    {
        $take = 5;
        $query = $this->repository->get_last_sales($take);
        return $query;
    }

    public function get_productos_vendidos_and_monto_total_ventas()
    {
        $take = 5;
        $query = $this->repository->get_cantidad_productos_vendidos_and_monto_total_by_and_moth($take);
        return $query;
    }
    
    
    public function get_count()
    {
        $query = $this->repository->get_count();
        return $query;
    }
}
