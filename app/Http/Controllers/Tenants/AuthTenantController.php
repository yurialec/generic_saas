<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Admin\Clients;
use App\Models\Tenants\Tenant;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;

class AuthTenantController extends Controller
{
    public function showLoginForm($tenant)
    {
        $tenant = Tenant::where('domain', $tenant)->first();
        if (empty($tenant)) {
            return response("Usuário não localizado.", 400);
        }

        if (!empty(session('tenant'))) {
            return redirect()->route('tenant.dashboard', ['tenant' => session('tenant')]);
        }

        $name = $tenant->name;
        return view('tenant.auth.index', compact('name'));
    }

    public function login(Request $request, $urlTenant)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $client = Clients::where('email', $credentials['email'])
            ->with('tenant')
            ->first();

        if (empty($client)) {
            return response("Usuário não localizado.", 400);
        }

        if ($urlTenant !== $client->tenant->domain) {
            return response("Informe o e-mail correto para realizar login.", 400);
        }

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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $urlTenant = $request->route('tenant');
        $name = Tenant::where('domain', $urlTenant)->first()->name;
        return view('tenant.auth.index', compact('name'));
    }
}
