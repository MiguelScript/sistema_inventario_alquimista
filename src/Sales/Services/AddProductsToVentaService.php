<?php

namespace Src\Sales\Services;

use Src\ProductosVentas\Repository\ProductosVentasRepository;


class AddProductsToVentaService
{
    protected $repository;

    public function __construct(ProductosVentasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $products, int $venta_id)
    {
        $data = array();

        foreach ($products as $key => $product) {
            $item = array(
                'producto_id' => $product->id,
                'producto_cantidad' => $product->cantidad,
                'producto_precio_unitario' => $product->precio_costo,
                'producto_porcentaje_ganacia' => $product->porcentaje_ganancia,
                'venta_id' => $venta_id,
            );

            $data[] = $item;
        }

        $add_products = $this->repository->insert_products($data, $venta_id);

        return $add_products;
    }
}
