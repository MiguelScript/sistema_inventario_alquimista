<?php

namespace Src\Products\Services;

use Src\Products\Repository\ProductRepository;

use function PHPUnit\Framework\isEmpty;

class GetProductsService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($offset, $limit, $search)
    {

        if ($search == "") {
            $query = $this->repository->get_products_by_offset_and_limit($offset, $limit);
            $total_productos = $this->repository->get_count();
        } else if ($search != "" & empty($offset)) {
            $query = $this->repository->get_active_products_by_search($search);
            $total_productos = $this->repository->get_count_by_active_and_search($search);
        } else {
            $query = $this->repository->get_products_by_offset_and_limit_and_search($offset, $limit, $search);
            $total_productos = $this->repository->get_count_by_search($search);
        }
        return [
            'productos' => $query,
            'total_productos' => $total_productos
        ];
    }
}
