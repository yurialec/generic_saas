<?php

namespace App\Services\Tenants;

use App\Repositories\Tenants\PatientRepository;

class PatientService
{
    protected $PatientRepository;

    public function __construct(PatientRepository $PatientRepository)
    {
        $this->PatientRepository = $PatientRepository;
    }

    public function all()
    {
        return $this->PatientRepository->all();
    }
}