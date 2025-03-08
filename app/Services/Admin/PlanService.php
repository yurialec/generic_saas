<?php

namespace App\Services\Admin;

use App\Repositories\Admin\PlanRepository;

class PlanService
{
    protected $PlanRepository;

    public function __construct(PlanRepository $PlanRepository)
    {
        $this->PlanRepository = $PlanRepository;
    }

    public function all()
    {
        return $this->PlanRepository->all();
    }
}