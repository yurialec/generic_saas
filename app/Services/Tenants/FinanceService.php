<?php

namespace App\Services\Tenants;

use App\Repositories\Tenants\FinanceRepository;

class FinanceService
{
    protected $FinanceRepository;

    public function __construct(FinanceRepository $FinanceRepository)
    {
        $this->FinanceRepository = $FinanceRepository;
    }

    public function all()
    {
        return $this->FinanceRepository->all();
    }
}