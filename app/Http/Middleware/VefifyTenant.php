<?php

namespace App\Http\Middleware;

use App\Models\Tenants\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VefifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenantUrl = $request->route('tenant');
        if (!$tenantUrl) {
            return abort(404, 'Tenant não encontrado.');
        }

        $tenant = Tenant::where('domain', $tenantUrl)->first();
        if (!$tenant) {
            return abort(404, 'Tenant inválido.');
        }


        return $next($request);
    }
}
