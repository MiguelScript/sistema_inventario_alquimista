<?php

namespace Src\Sales\Services;

use Src\Sales\Repository\SaleRepository;
use Illuminate\Http\Request;


class CreateSaleService
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $venta = array(
            'status' => 1
        );
        //$venta = $request->get('status');
        $productos = json_decode($request->get('productos'));
        //$venta_dto = new CreateVentaDto();
        //$dto = $venta_dto->fromRequest($venta);
        $venta_id = $this->repository->create($venta);

        
        
        return $venta_id;
    }

    public function setResponse($query)
    {
        if ($query) {
            return response([
                'data' => $query,
                'msg' => "se ha creado el usuario exitosamente",
            ], 200);
        } else {
            return response([
                'data' => $query,
                'msg' => "Ha ocurrido un error al crear el usuario",
            ], 400);
        }
    }
}
