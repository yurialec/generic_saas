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
            $this->patient->full_name = $data['full_name'];
            $this->patient->group = $data['group'];
            $this->patient->gender = $data['gender'];
            $this->patient->age = $data['age'];
            $this->patient->cpf = $data['cpf'];
            $this->patient->email = $data['email'];
            $this->patient->phone = $data['phone'];
            $this->patient->guardian_name = $data['guardian_name'];
            $this->patient->guardian_phone = $data['guardian_phone'];
            $this->patient->emergency_contact = $data['emergency_contact'];
            $this->patient->emergency_phone = $data['emergency_phone'];
            $this->patient->payment_plan = $data['payment_plan'];
            $this->patient->notes = $data['notes'];
            $this->patient->tenant_id = (int) session('tenant');

            $this->patient->save();

        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return response()->json([
                'message' => $err->getMessage(),
            ], 400);
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