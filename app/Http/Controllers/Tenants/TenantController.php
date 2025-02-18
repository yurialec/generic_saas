<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use App\Services\Tenants\TenantService;
use DB;
use Exception;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $TenantService;

    public function __construct(TenantService $TenantService)
    {
        $this->TenantService = $TenantService;
    }

    public function index($tenant)
    {
        $result = DB::table('tenant')
            ->where('domain', $tenant)
            ->first();

        if (!empty($result)) {
            return 'OK ENcontrado!';
        }

        return 'Não localizado!';
    }
}