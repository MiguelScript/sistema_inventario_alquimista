<?php

namespace Src\Sales\Services;

use Src\Sales\Repository\SaleRepository;
use Exception;

class ChangeStatusService
{

    protected $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        $product_id, $status
    ) {

        switch ($status) {
            case 'incompleted':

                $status_value = SaleRepository::VENTA_EN_PROCESO;

                break;
            case 'completed':

                $status_value = SaleRepository::VENTA_FINALIZADA;

                break;
            case 'cancel':

                $status_value = SaleRepository::VENTA_ANULADA;

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
