<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}