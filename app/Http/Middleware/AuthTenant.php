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

        if (!empty(session('user'))) {
            $user = session('user');
            $domain = $user->with('tenant')->first()->tenant->domain;

            return $next($request);
        }

        return redirect()->route('tenant.login.form', parameters: ['tenant' => $urlTenant]);

        // if ($domain !== $urlTenant) {
        //     return redirect()->route('tenant.login.form', ['tenant' => $urlTenant]);
        // }
    }
}
