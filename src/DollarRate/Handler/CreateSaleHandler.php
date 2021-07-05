<?php

namespace Src\Sales\Handler;

use Src\Sales\UseCases\CreateSaleUseCase;

class CreateSaleHandler
{

    protected $create_sale_usecase;

    public function __construct(CreateSaleUseCase $create_sale_usecase)
    {
       $this->create_sale_usecase = $create_sale_usecase;
    }

    public function __invoke($request)
    {
        $sale_amount    = $request->input('subtotal');
        $products    = json_decode($request->input('products'));

        $sale_id = $this->create_sale_usecase->__invoke(
            $sale_amount, $products
        );

        return $this->setResponse($sale_id);
    }

    public function setResponse($query)
    {
        if ($query) {
            return [
                'data' => $query,
                'msg' => "se ha anulado la venta exitosamente",
            ];
        } else {
            return [
                'data' => $query,
                'msg' => "Ha ocurrido un error al anulado la venta",
            ];
        }
    }
}
