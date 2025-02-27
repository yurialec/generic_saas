<?php

namespace App\Services\Admin;

use App\Repositories\Admin\ClientPaymentPlanRepository;

class ClientPaymentPlanService
{
    protected $ClientPaymentPlanRepository;

    public function __construct(ClientPaymentPlanRepository $ClientPaymentPlanRepository)
    {
        $this->ClientPaymentPlanRepository = $ClientPaymentPlanRepository;
    }

    public function all()
    {
        return $this->ClientPaymentPlanRepository->all();
    }
}