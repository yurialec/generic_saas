<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Services\Tenants\FinanceService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    protected $FinanceService;

    public function __construct(FinanceService $FinanceService)
    {
        $this->FinanceService = $FinanceService;
    }

    public function index()
    {
        return view('tenant.finance.index');
    }

    public function create()
    {
        return view('tenant.create.index');
    }
}