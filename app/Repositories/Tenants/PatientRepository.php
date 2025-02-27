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

    public function create(array $data)
    {
        try {

            $patient = $this->patient->create([
                'full_name' => $data['full_name'],
                'group' => $data['group'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'guardian_name' => $data['guardian_name'],
                'guardian_phone' => $data['guardian_phone'],
                'emergency_contact' => $data['emergency_contact'],
                'emergency_phone' => $data['emergency_phone'],
                'payment_plan' => $data['payment_plan'],
                'notes' => $data['notes'],
            ]);
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
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
        return Patient::destroy($id);
    }
}