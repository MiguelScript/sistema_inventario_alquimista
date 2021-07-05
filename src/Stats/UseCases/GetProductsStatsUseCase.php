<?php

namespace Src\Stats\UseCases;

use Src\Stats\Services\GetProductsStatsService;

class GetProductsStatsUseCase
{

    protected $get_products_service;

    public function __construct(GetProductsStatsService $get_products_service)
    {
        $this->get_products_service = $get_products_service;
    }

    public function __invoke()
    {
        $products_in_min_stock = $this->get_products_service->get_products_in_min_stock();
        $data = array('products_in_min_stock' => $products_in_min_stock);
        return $data;
    }

    public function setResponse($query)
    {
        if ($query['productos']) {
            return [
                'data' => $query,
                'msg' => "se han encontrado productos",
            ];
        } else {
            return [
                'data' => $query,
                'msg' => "Oh no, no se han encontrado productos",
            ];
        }
    }
}
