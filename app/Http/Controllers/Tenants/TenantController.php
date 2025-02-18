<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use App\Services\Tenants\TenantService;

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
        return "olá: " . $name;
    }
}