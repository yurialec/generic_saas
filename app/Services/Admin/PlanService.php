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

    public function create($data)
    {
        $planData['name'] = $data['name'];
        $planData['price'] = $data['price'];
        $planData['description'] = $data['description'];
        $planData['duration'] = $data['duration'];
        $planData['features'] = json_encode($data['features']);

        return $this->PlanRepository->create($planData);
    }
}