<?php

namespace App\Http\Middleware;

use App\Models\Tenants\Tenant;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $urlTenant = $request->route('tenant');

        $tenant = Tenant::where('domain', $urlTenant)->first();
        if (!$tenant) {
            return redirect()->route('index.site');
        }

        $user = session('user');
        $domain = $user->with('tenant')->first()->tenant->domain;

        if ($domain !== $urlTenant) {
            return redirect()->route('tenant.login.form', ['tenant' => $urlTenant]);
        }

        return $next($request);
    }
}
