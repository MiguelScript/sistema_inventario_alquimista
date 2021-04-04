<?php

namespace Src\Products\Services;

use Src\Products\Repository\ProductRepository;
use Exception;

class ChangeStatusService
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $product_id, $status
    ) {

        switch ($status) {
            case 'enable':

                $status_value = ProductRepository::PRODUCTO_ACTVO;

                break;
            case 'disable':

                $status_value = ProductRepository::PRODUCTO_INHABILITADO;

                break;
            case 'delete':

                $status_value = ProductRepository::PRODUCTO_ELIMINADO;

                break;
            
            default:
            
                throw new Exception("Error Processing Status", 1);
                
                break;
        }

        $status = array(
            'status' => $status_value
        );
        
        $query = $this->repository->change_status($status, $product_id);
        return $query;
    }
}
