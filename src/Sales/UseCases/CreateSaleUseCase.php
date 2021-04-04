<?php

namespace Src\Sales\UseCases;

use Src\Sales\Services\CreateSaleService;
use Src\Sales\Services\CreateSaleCodeService;
//add products to Sale
use Src\Sales\Services\AddProductsToVentaService;

class CreateSaleUseCase
{

    protected $create_sale_service;
    protected $create_sale_code_service;
    protected $add_products_to_sale_service;

    public function __construct(
        CreateSaleService $create_sale_service, 
        CreateSaleCodeService $create_sale_code_service, 
        AddProductsToVentaService $add_products_to_sale_service 
        )
    {
        $this->create_sale_service      = $create_sale_service;
        $this->create_sale_code_service = $create_sale_code_service;
        $this->add_products_to_sale_service = $add_products_to_sale_service;
    }

    public function __invoke($sale_amount, array $products)
    {

        //$create_products_service = new CreateSaleService($this->repository);
        $sale_id = $this->create_sale_service->__invoke(
            $sale_amount
        );

        //$create_product_code_service = new CreateSaleCodeService($this->repository);
        $codigo = $this->create_sale_code_service->__invoke($sale_id);

        if ($codigo) {
            $set_productos = $this->add_products_to_sale_service->__invoke($products, $sale_id);
        }

        return $sale_id;
    }
}