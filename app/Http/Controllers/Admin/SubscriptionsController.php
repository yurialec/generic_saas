<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SubscriptionsService;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    protected $SubscriptionsService;

    public function __construct(SubscriptionsService $SubscriptionsService)
    {
        $this->SubscriptionsService = $SubscriptionsService;
    }

    public function index()
    {
        return view('admin.financial.subscriptions.index');
    }
}