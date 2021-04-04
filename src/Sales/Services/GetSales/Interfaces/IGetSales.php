<?php

namespace Src\Sales\Services\GetSales\Interfaces;

interface IGetSales 
{
    public function get_sales($offset, $limit);

    public function get_count();
}
