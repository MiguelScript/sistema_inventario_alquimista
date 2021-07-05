<?php

namespace Src\Products\Repository;

use Src\Products\Model\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    protected $model;
    const PRODUCTO_INHABILITADO = 0;
    const PRODUCTO_ACTVO        = 1;
    const PRODUCTO_ELIMINADO    = 2;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get_active_products_by_search($search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->where('status',1)->get();
    }

    public function get_products_in_min_stock()
    {
        return DB::table('productos')
        ->whereColumn('cantidad', '<=', 'cantidad_minima')
        ->get();
         //$this->model->where('cantidad','<=','cantidad_minima')->get();
    }

    public function get_products_by_offset_and_limit($offset, $limit)
    {
        return $this->model->skip($offset)->take($limit)->orderBy('id', 'desc')->get();
    }

    public function get_count()
    {
        return $this->model->get()->count();
    }

    public function get_products_by_offset_and_limit_and_search($offset, $limit, $search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->skip($offset)->take($limit)->orderBy('id', 'desc')->get();
    }

    public function get_count_by_search($search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->get()->count();
    }

    public function get_count_by_active_and_search($search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->where('status',1)->get()->count();
    }

    public function create($data)
    {
        $producto_data = $data->toArray();
        return $this->model->insertGetId($producto_data);
    }

    public function update($data, $id)
    {
        $producto_data = (!is_array($data)) ? $data->toArray() : $data;

        return $this->model->where('id', $id)
            ->update($producto_data);
    }

    public function update_batch($products)
    {
        foreach ($products as $key => $product) {
            DB::table("productos")
                ->where('id', $product["id"])
                ->update($product);
        }

        return true;
    }

    public function update_cantidad_disponible($products)
    {
        foreach ($products as $key => $product) {
            DB::table("products")
                ->where('id', $product->id)
                ->increment('cantidad', $product->cantidad_comprada);
        }
    }

    public function change_status($status, $id)
    {
        return $this->model->where('id', $id)
            ->update($status);
    }

    public function find($id)
    {
        if (null == $product = $this->model->find($id)) {
            throw new ModelNotFoundException("Product not found");
        }

        return $product;
    }
}
