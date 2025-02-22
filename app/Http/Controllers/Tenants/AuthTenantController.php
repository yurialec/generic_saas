<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Tenant;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;

class AuthTenantController extends Controller
{
    public function showLoginForm($tenant)
    {
        $name = Tenant::where('domain', $tenant)->first()->name;
        return view('tenant.auth.index', compact('name'));
    }

    public function login(Request $request, $urlTenant)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            $tenant = Tenant::where('domain', $urlTenant)->first()->domain;

            if (Auth::guard('client')->attempt($credentials)) {
                $user = Auth::guard('client')->user();

                session(['user' => $user]);
                session(['tenant' => $tenant]);

                return redirect()->route('tenant.dashboard', ['tenant' => $urlTenant]);
            }
        } catch (Exception $err) {
            Log::error('ERRO AO REALIZAR LOGIN', ['erro' => $err->getMessage()]);
            return back()->withErrors(['login' => $err->getMessage()]);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        session()->forget('user');
        session()->forget('tenant');

        return response()->json([
            'message' => 'Logout realizado com sucesso!',
        ]);
    }
}
