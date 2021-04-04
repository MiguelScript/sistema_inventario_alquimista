<?php

namespace Src\Sales\Services;


use Src\Sales\Repository\SaleRepository;
use Src\Sales\Services\GetSalesService;
use Src\Sales\Services\GetSales\GetSalesByStatusService;
use Src\Sales\Services\GetSales\GetSalesBySearchService;
use Src\Sales\Services\GetSales\GetSalesByStatusAndSearchService;
use Src\Sales\Services\GetSales\GetSalesAllService;

use Exception;

class GetSalesFactory
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $search, $status) : GetSalesService
    {
        if ($search !== "" && $status !== "") {
            //por una busqueda y un status

            return new GetSalesService(new GetSalesByStatusAndSearchService($this->repository, $status, $search));
        } elseif ($search !== "" && $status == "") {
            //por una busqueda y todos los status

            return new GetSalesService(new GetSalesBySearchService($this->repository, $search));
        } elseif ($search == "" && $status !== "") {
            //por un status

            return new GetSalesService(new GetSalesByStatusService($this->repository, $status));
        } elseif ($search == "" && $status == "") {
            //sin busqueda y todos los status
            return new GetSalesService(new GetSalesAllService($this->repository));

        } else {

            throw new Exception("Caso no definido en la fabrica", 1);
            
        }
    }
}
