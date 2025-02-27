<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $patient = $this->PatientService->create($request->all());

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
}