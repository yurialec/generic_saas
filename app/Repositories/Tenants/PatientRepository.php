<?php

namespace App\Repositories\Tenants;

use App\Interfaces\Tenants\PatientRepositoryInterface;
use App\Models\Tenants\Patient;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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
            return $this->patient->where('tenant_id', session('tenant'))->paginate(10);
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
            return $this->patient->create($data);
        } catch (Exception $e) {
            Log::error('Erro ao criar paciente', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function update($id, array $data)
    {
        try {
            $patient = $this->patient->find($id);
            $patient->fill($data);
            return $patient->save();
        } catch (Exception $e) {
            Log::error('Erro', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function disable($id)
    {
        try {
            $patient = $this->patient->find($id);
            $patient->deleted_at ? $patient->deleted_at = null : $patient->deleted_at = Carbon::now();
            return $patient->save();
        } catch (Exception $e) {
            Log::error('Erro', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function getPatientById($id)
    {
        try {
            return $this->patient->find($id);
        } catch (Exception $e) {
            Log::error('Erro', ['error' => $e->getMessage()]);
            return null;
        }
    }
}