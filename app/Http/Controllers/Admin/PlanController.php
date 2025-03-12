<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Financial\Plan\StorePlanRequest;
use App\Services\Admin\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $PlanService;

    public function __construct(PlanService $PlanService)
    {
        $this->PlanService = $PlanService;
    }

    public function index()
    {
        return view('admin.financial.plan.index');
    }

    public function list(Request $request)
    {
        $plans = $this->PlanService->all();

        if ($plans) {
            return response()->json([
                'status' => true,
                'plans' => $plans
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
        return view('admin.financial.plan.create');
    }

    public function store(StorePlanRequest $request)
    {
        $patient = $this->PlanService->create($request->all());

        if ($patient) {
            return response()->json([
                'status' => true,
                'patient' => $patient,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar plano'
            ], 204);
        }
    }
}