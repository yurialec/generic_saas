<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ClientPaymentPlanService;
use Illuminate\Http\Request;

class ClientPaymentPlanController extends Controller
{
    protected $ClientPaymentPlanService;

    public function __construct(ClientPaymentPlanService $ClientPaymentPlanService)
    {
        $this->ClientPaymentPlanService = $ClientPaymentPlanService;
    }

    public function index()
    {
        return view('admin.clients.paymentplan.index');
    }

    public function create()
    {
        return view('admin.clients.paymentplan.create');
    }
}