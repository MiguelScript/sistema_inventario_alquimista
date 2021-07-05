<?php

namespace Src\Products\UseCases;

use Src\Sales\Services\GetproductsFromSale;
use Src\Sales\Services\CreateSaleCodeService;

//add products to Sale
use Src\Products\Services\UpdateMultipleProductsService;

class CreateSaleUseCase
{

    protected $create_sale_service;
    protected $create_sale_code_service;
    protected $update_multiple_products_service;

    public function __construct(
        GetproductsFromSale $get_products_from_sale_service, 
        CreateSaleCodeService $create_sale_code_service, 
        UpdateMultipleProductsService $update_multiple_products_service 
        )
    {
        $this->get_products_from_sale_service      = $get_products_from_sale_service;
        $this->create_sale_code_service = $create_sale_code_service;
        $this->update_multiple_products_service = $update_multiple_products_service;
    }

    public function __invoke($products,  $sale_id)
    {

        //$create_products_service = new CreateSaleService($this->repository);
        $products_in_sale = $this->get_products_from_sale_service->__invoke(
            $sale_id
        );

        if (!$products_in_sale) {
            return 0;
        }

        $update_cantidad_products = $this->update_multiple_products_service->__invoke(
            $products_in_sale
        );

        

        return $update_cantidad_products;
    }
}