<?php

namespace App\Http\Middleware;

use App\Models\Tenants\Tenant;
use Auth;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VefifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Auth::guard('client')->logout();
        // session()->forget('user');

        $urlTenant = $request->route('tenant');

        if (!empty(session('user'))) {
            return redirect()->route('tenant.dashboard', parameters: ['tenant' => $urlTenant]);
        }

        if (!$urlTenant) {
            return response()->json(['Tenant não encontrado.'], 404);
        }

        $tenant = Tenant::where('domain', $urlTenant)->first();
        if (!$tenant) {

            return redirect()->route('tenant.dashboard', parameters: ['tenant' => $urlTenant]);
        }

        return $next($request);
    }
}
