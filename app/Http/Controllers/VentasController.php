<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Ventas\CreateVentaRequest;
use Src\Ventas\Services\CreateVentaService;

class VentasController extends Controller
{
    public function index()
    {
        return response('Hello World', 200);
    }

    public function get_ventas(Request $request)
    {
        $response = $this->ventas_service->get_ventas($request);

        return $response;
    }

    public function store(Request $request)
    {
        // Validate the request...
        $create_venta_service = new CreateVentaService();
        $create = $this->ventas_service->create($request);

        return $create;
    }

    public function delete(Request $request)
    {
        // Validate the request...
        $anulacion = $this->ventas_service->anular_factura($request);

        return $anulacion;
    }
}
