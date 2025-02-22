<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use App\Services\Tenants\TenantService;
use Auth;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $TenantService;

    public function __construct(TenantService $TenantService)
    {
        $this->TenantService = $TenantService;
    }

    public function dashboard()
    {
        return view('tenant.dashboard.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout realizado com sucesso!',
        ]);
    }

    public function configuration()
    {
        return 'HAHAHAHAHHAHAHAH';
    }
}