<?php

namespace Src\Sales\Services\GetSales\Interfaces;

interface IGetSalesCount 
{
    public function make(string $search, $status);
}
