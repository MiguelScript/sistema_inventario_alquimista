<?php

namespace Src\ProductosVentas\Services;

use Src\ProductosVentas\Repository\ProductosVentasRepository;
use App\Repositories\Products\ProductRepository;


class ReturnProductsToStockService
{

    protected $repository;
    protected $product_repository;
    protected $productos;

    public function __construct(ProductosVentasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function make($venta_id)
    {
        $productos_venta = $this->repository->get_productos_and_cantidad_comprada_by_venta_id($venta_id);

        //$productos_model = new ProductRepository();

        

        /* $data = array();

        foreach ($productos as $key => $producto) {
            $item = array(
                'producto_id' => $producto->id, 
                'producto_cantidad' => $producto->cantidad, 
                'producto_precio_unitario' => $producto->precio_costo, 
                'producto_porcentaje_ganacia' => $producto->porcentaje_ganancia, 
                'venta_id' => $venta_id, 
            );

            $data[] = $item;  
        }
        
        $add_products = $this->repository->insert_products($data, $venta_id);
        
        return $this->setResponse($add_products); */
    }

    public function setResponse($query)
    {
        if ($query) {
            return response([
                'data' => $query,
                'msg' => "se ha creado el usuario exitosamente",
            ], 200);
        } else {
            return response([
                'data' => $query,
                'msg' => "Ha ocurrido un error al crear el usuario",
            ], 400);
        }
    }
}
