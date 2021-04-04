<?php

namespace Src\Sales\Services;

use Src\Sales\Repository\SaleRepository;

class CreateSaleCodeService
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($sale_id)
    {
        $data = array('codigo' => "VEN" . $sale_id,);

        return $this->repository->update($data, $sale_id);
    }
}