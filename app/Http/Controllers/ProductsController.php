<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Services\Products\ProductServices;


class ProductsController extends Controller
{
    protected $product_service;

    public function __construct(ProductServices $product_service)
    {
        $this->product_service = $product_service;
    }
    public function index()
    {
        return response('Hello World', 200);
    }

    public function get_products(Request $request)
    {
        $response = $this->product_service->get_products($request);

        return $response;
    }

    public function store(CreateProductRequest $request)
    {
        // Validate the request...
        $create = $this->product_service->create($request);

        return $create;
    }

    public function update(UpdateProductRequest $request)
    {
        $update = $this->product_service->update($request);

        return $update;
    }
}
