<?php

namespace Src\Sales\Repository;

use Src\Sales\Model\Sale;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SaleRepository
{
    protected $model;
    const VENTA_ANULADA     = 0;
    const VENTA_FINALIZADA  = 1;
    const VENTA_EN_PROCESO  = 2;

    /**
     * SaleRepository constructor.
     *
     * @param Sale $post
     */
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get_sales_by_offset_and_limit($offset, $limit)
    {
        return $this->model->skip($offset)->take($limit)->get();
    }

    public function get_count()
    {
        return $this->model->get()->count();
    }

    public function get_sales_by_offset_and_limit_and_search($offset, $limit, $search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->skip($offset)->take($limit)->get();
    }

    public function get_count_by_search($search)
    {
        return $this->model->where('codigo', 'like', '%' . $search . '%')->get()->count();
    }

    public function get_sales_by_offset_and_limit_and_status($offset, $limit, $status)
    {
        return $this->model->where('status', '=', $status)->skip($offset)->take($limit)->get();
    }

    public function get_count_by_status($status)
    {
        return $this->model->where('status', '=', $status)->get()->count();
    }

    public function get_sales_by_offset_and_limit_and_status_and_search($offset, $limit, $status ,$search)
    {
        return $this->model
                ->where('nombre', 'like', '%' . $search . '%')
                ->where('status', '=', $status)
                ->skip($offset)->take($limit)->get();
    }

    public function get_count_by_status_and_search($status, $search)
    {
        return $this->model
        ->where('status', '=', $status)->get()->count()
        ->where('nombre', 'like', '%' . $search . '%');
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
