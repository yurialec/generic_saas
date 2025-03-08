<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PaymentsService;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    protected $PaymentsService;

    public function __construct(PaymentsService $PaymentsService)
    {
        $this->PaymentsService = $PaymentsService;
    }

    public function index()
    {
        return view('admin.financial.payments.index');
    }
}