<?php

namespace Src\Products\UseCases;

use Src\Products\Services\GetProductsService;

class GetProductsUseCase
{

    protected $get_products_service;

    public function __construct(GetProductsService $get_products_service)
    {
        $this->get_products_service = $get_products_service;
    }

    public function __invoke($request)
    {

        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $search = $request->get('search');
        $status = $request->get('search');

        $products = $this->get_products_service->__invoke(
            $offset, $limit, $search, $status
        );

        return $this->setResponse($products);
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
