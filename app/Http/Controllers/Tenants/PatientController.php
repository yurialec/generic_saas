<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Patient\StorePatientRequest;
use App\Http\Requests\Tenant\Patient\UpdatePatientRequest;
use App\Services\Tenants\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $PatientService;

    public function __construct(PatientService $PatientService)
    {
        $this->PatientService = $PatientService;
    }

    public function index()
    {
        return view('tenant.patient.index');
    }

    public function list(Request $request)
    {
        $patients = $this->PatientService->all();

        if ($patients) {
            return response()->json([
                'status' => true,
                'patients' => $patients
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }

    public function create()
    {
        return view('tenant.patient.create');
    }

    public function store(StorePatientRequest $request)
    {
        $patient = $this->PatientService->create($request->validated());

        if ($patient) {
            return response()->json([
                'status' => true,
                'patient' => $patient,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário'
            ], 204);
        }
    }

    public function disable(Request $request)
    {
        $client = $this->PatientService->disable($request->patient['id']);
        if ($client) {
            return response()->json([
                'status' => true,
                'message' => 'Paciente excluio com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir Paciente'
            ], 204);
        }
    }

    public function edit($tenant, $id)
    {
        return view('tenant.patient.edit', compact('id'));
    }

    public function getPatientById($tenant, $id)
    {
        $patientById = $this->PatientService->getPatientById($id);
        if ($patientById) {
            return response()->json([
                'status' => true,
                'patientById' => $patientById,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir Paciente'
            ], 204);
        }
    }

    public function update($tenant, $id, Request $request)
    {
        $patient = $this->PatientService->update($id, $request->patient);

        if ($patient) {
            return response()->json([
                'status' => true,
                'patient' => $patient,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar paciente'
            ], 204);
        }
    }
}