<?php

namespace Src\Sales\Services;

use Src\ProductosVentas\Repository\ProductosVentasRepository;

class GetproductsFromSale
{

    protected $repository;

    public function __construct(ProductosVentasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($sale_id)
    {
        return $this->repository->get_productos_and_cantidad_comprada_by_venta_id($sale_id);
    }
}