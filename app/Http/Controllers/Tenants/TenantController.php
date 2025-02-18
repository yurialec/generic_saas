<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use App\Services\Tenants\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $TenantService;

    public function __construct(TenantService $TenantService)
    {
        $this->TenantService = $TenantService;
    }

    public function showLoginForm($tenant)
    {
        $name = Tenant::where('domain', $tenant)->first()->name;
        return view('tenant.auth.index', compact('name'));
    }

    public function login(Request $request)
    {
        dd($request->all());
    }
}