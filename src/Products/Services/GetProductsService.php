<?php

namespace App\Services\Products;

use Src\Products\Repository\ProductRepository;
use Illuminate\Http\Request;


class GetProductsService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function make(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $search = $request->get('search');

        if ($search == "") {
            $query = $this->repository->get_products_by_offset_and_limit($offset, $limit);
            $total_productos = $this->repository->get_count();
        } else {
            $query = $this->repository->get_products_by_offset_and_limit_and_search($offset, $limit, $search);
            $total_productos = $this->repository->get_count_by_search($search);
        }
        return $this->setResponse($query, $total_productos);
    }

    public function setResponse($query, $total_productos)
    {
        if (count($query) > 0) {
            return response([
                'data' => array(
                    'productos' => $query,
                    'total_productos' => $total_productos
                ),
                'msg' => "Se ha encontrado productos",
            ], 200);
        } else {
            return response([
                'data' => array(
                    'productos' => $query,
                    'total_productos' => $total_productos
                ),
                'msg' => "Oh no, no se han encontrado productos",
            ], 200);
        }
    }
}
