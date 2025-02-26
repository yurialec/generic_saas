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
}