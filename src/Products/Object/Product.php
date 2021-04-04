<?php

declare(strict_types=1);

namespace Src\Products\Object;

final class Product
{
    private $name;
    private $quantity;
    private $price_cost;
    private $price_sale;
    private $percentage_profit;

    public function __construct(
        $name,
        $quantity,
        $price_cost,
        $price_sale,
        $percentage_profit
    ) {
        $this->name                 =   $name;
        $this->quantity             =   $quantity;
        $this->price_cost           =   $price_cost;
        $this->price_sale           =   $price_sale;
        $this->percentage_profit    =   $percentage_profit;
    }

    public function name()
    {
        return $this->name;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function price_cost()
    {
        return $this->price_cost;
    }

    public function price_sale()
    {
        return $this->price_sale;
    }

    public function percentage_profit()
    {
        return $this->percentage_profit;
    }

    public function create(): Product
    {
        $product = new self($this->name, $this->quantity,  $this->price_cost, $this->price_sale, $this->percentage_profit);

        return $product;
    }

    public function toArray(): array
    {
        $product = array(
            "nombre"                =>   $this->name, 
            "cantidad"              =>   $this->quantity,  
            "precio_costo"          =>   $this->price_cost, 
            "precio_venta"          =>   $this->price_sale, 
            "porcentaje_ganancia"   =>   $this->percentage_profit,
            "status"                =>   1
        );

        return $product;
    }
}
