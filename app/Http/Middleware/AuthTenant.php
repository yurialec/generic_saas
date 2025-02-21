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
    public function handle(Request $request, Closure $next)
    {
        $urlTenant = $request->route('tenant');

        if (!empty(session('user'))) {
            $user = session('user');
            $domain = $user->with('tenant')->first()->tenant->domain;
            if ($domain === $urlTenant) {
                return $next($request);
            }
        }

        return redirect()->route('faca-parte');
    }
}
