<?php

namespace App\Repositories\Tenants;

use App\Interfaces\Tenants\PatientRepositoryInterface;
use App\Models\Tenants\Patient;
use Exception;
use Log;

class PatientRepository implements PatientRepositoryInterface
{
    protected $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function all()
    {
        try {
            return $this->patient->paginate(10);
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function find($id)
    {
        return Patient::find($id);
    }

    public function create(array $data): ?Patient
    {
        try {
            $data['tenant_id'] = (int) session('tenant');

            $patient = new Patient();
            $patient->fill($data);

            if ($patient->save()) {
                return $patient;
            }
            return null;

        } catch (Exception $e) {
            Log::error('Erro ao criar paciente', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function update($id, array $data)
    {
        $model = Patient::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        try {
            return $this->patient->find($id)->delete();
        } catch (Exception $e) {
            Log::error('Erro', ['error' => $e->getMessage()]);
            return null;
        }
    }
}