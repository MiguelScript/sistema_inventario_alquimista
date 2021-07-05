<?php

namespace Src\Sales\UseCases;

use Src\Sales\Services\CreateSaleService;
use Src\Sales\Services\CreateSaleCodeService;
//add products to Sale
use Src\Sales\Services\AddProductsToVentaService;
use Src\Products\Services\UpdateMultipleProductsService;
//discount products from stock
use Src\Sales\Services\GetproductsFromSale;

use Src\Sales\Repository\SaleRepository;
use Src\ProductosVentas\Repository\ProductosVentasRepository;

class CreateSaleUseCase
{

    protected $create_sale_service;
    protected $create_sale_code_service;
    protected $add_products_to_sale_service;
    protected $get_products_from_sale_service;
    protected $update_multiple_products_service;
    protected $productos_ventas_repository;

    public function __construct(
        CreateSaleService $create_sale_service,
        CreateSaleCodeService $create_sale_code_service,
        AddProductsToVentaService $add_products_to_sale_service,
        UpdateMultipleProductsService $update_multiple_products_service,
        ProductosVentasRepository $productos_ventas_repository
    ) {
        $this->create_sale_service      = $create_sale_service;
        $this->create_sale_code_service = $create_sale_code_service;
        $this->add_products_to_sale_service = $add_products_to_sale_service;
        $this->update_multiple_products_service = $update_multiple_products_service;
        $this->productos_ventas_repository = $productos_ventas_repository;
    }

    public function __invoke($sale_amount, array $products)
    {

        //$create_products_service = new CreateSaleService($this->repository);
        $sale_id = $this->create_sale_service->__invoke(
            $sale_amount
        );

        //$create_product_code_service = new CreateSaleCodeService($this->repository);
        $codigo = $this->create_sale_code_service->__invoke($sale_id);

        if (!$codigo) {
            return 0;
        }

        $add_products_to_sale = $this->add_products_to_sale($products, $sale_id);

        if (!$add_products_to_sale) {
            //no se ha logrado añadir los productos a la venta
            return 0;
        }

        $discount_products_from_stock = $this->discount_products_from_stock($sale_id);

        if (!$discount_products_from_stock) {
            //Ha ocurrido un error al descontar los productos del inventario
            return 0;;
        }

        return $sale_id;
    }

    public function add_products_to_sale($products, $sale_id)
    {
        $add_products_to_sale_service = new AddProductsToVentaService($this->productos_ventas_repository);
        $add_products_to_sale = $add_products_to_sale_service->__invoke($products, $sale_id);

        return $add_products_to_sale;
    }

    public function discount_products_from_stock($sale_id)
    {
        $get_products = new GetproductsFromSale($this->productos_ventas_repository);
        $products_in_sale = $get_products->__invoke($sale_id);

        if (!$products_in_sale) {
            return [];
        }

        //var_dump( json_decode($products_in_sale));

        $products_with_discount_of_quantity = array_map('self::discount_quantity_from_product', json_decode($products_in_sale));

        $query = $this->update_multiple_products_service->__invoke($products_with_discount_of_quantity);

        return $query;
    }

    public function discount_quantity_from_product($producto)
    {
        return (array(
            'id' => $producto->producto_id,
            'cantidad' =>  $producto->producto_cantidad_inventario - $producto->producto_cantidad
        ));
    }
}
