<?php

/* namespace Src\DollarRate\Services;

use Src\DollarRate\Repository\SaleRepository;
use Illuminate\Http\Request;


class CreateSaleService
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($sale_amount)
    {
        $venta = array(
            'monto_venta' => $sale_amount,
            'status' => 1
        );
        //$venta = $request->get('status');
        //$venta_dto = new CreateVentaDto();
        //$dto = $venta_dto->fromRequest($venta);
        $venta_id = $this->repository->create($venta);

        return $venta_id;
    } 
}
*/