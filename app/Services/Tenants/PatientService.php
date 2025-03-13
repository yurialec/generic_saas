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

    public function create(array $data)
    {
        $data['tenant_id'] = session('tenant');
        return $this->PatientRepository->create($data);
    }

    public function disable($id)
    {
        return $this->PatientRepository->disable($id);
    }

    public function getPatientById($id)
    {
        return $this->PatientRepository->getPatientById($id);
    }

    public function update($id, $patient)
    {
        return $this->PatientRepository->update($id, $patient);
    }
}