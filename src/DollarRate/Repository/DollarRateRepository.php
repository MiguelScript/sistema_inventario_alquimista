<?php

namespace Src\DollarRate\Repository;

use Src\DollarRate\Model\DollarRate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DollarRateRepository
{
    protected $model;
    const VENTA_ANULADA     = 0;
    const VENTA_FINALIZADA  = 1;
    const VENTA_EN_PROCESO  = 2;

    /**
     * DollarRateRepository constructor.
     *
     * @param DollarRate $post
     */
    public function __construct(DollarRate $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get_current_dollar_rate()
    {
        return $this->model
            ->take(1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function get_sales_by_offset_and_limit($offset, $limit)
    {
        return $this->model
            ->skip($offset)
            ->take($limit)
            ->orderBy('id', 'desc')
            ->get();
    }

    

    public function get_sales_by_offset_and_limit_and_search($offset, $limit, $search)
    {
        return $this->model
            ->where('codigo', 'like', '%' . $search . '%')
            ->skip($offset)
            ->take($limit)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function get_count_by_search($search)
    {
        return $this->model
            ->where('codigo', 'like', '%' . $search . '%')
            ->get()
            ->count();
    }

    public function create($venta)
    {
        return $this->model->insertGetId($venta);
    }

    public function update(array $data, $id)
    {
        //$producto_data = $data->toArray();

        return $this->model->where('id', $id)
            ->update($data);
    }

    public function change_status($status, $id)
    {
        return $this->model->where('id', $id)
            ->update($status);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $product = $this->model->find($id)) {
            throw new ModelNotFoundException("Product not found");
        }

        return $product;
    }

    public function get_products_from_sale($sale_id)
    {
        # code...
    }
}
