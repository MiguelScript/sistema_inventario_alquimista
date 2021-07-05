<?php

namespace Src\DollarRate\Handler;

use Src\DollarRate\Services\GetCurrentDollarRateService;

class GetDollarRateHandler
{

    protected $get_sales;

    public function __construct(GetCurrentDollarRateService $get_sales)
    {
       $this->get_sales = $get_sales;
    }

    public function __invoke()
    {
        //var_dump($request->input('status'));

        $current_dollar_rate = $this->get_sales->__invoke();

        return $this->setResponse($current_dollar_rate);
    }

    public function setResponse($tasa_dolar)
    {
        if (count($tasa_dolar) > 0) {
            return [
                'data' => array(
                    'tasa_dolar' => $tasa_dolar[0],
                ),
                'msg' => "Se ha encontrado ventas",
            ];
        } else {
            return [
                'data' => array(
                    'tasa_dolar' => $tasa_dolar,
                ),
                'msg' => "Oh no, no se han encontrado ventas",
            ];
        }
    }
}