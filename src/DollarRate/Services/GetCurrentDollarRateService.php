<?php

namespace Src\DollarRate\Services;

use Src\DollarRate\Repository\DollarRateRepository;

class GetCurrentDollarRateService
{

    protected $repository;
    protected $status;

    public function __construct(DollarRateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $query = $this->repository->get_current_dollar_rate();
        return $query;
    }
}
