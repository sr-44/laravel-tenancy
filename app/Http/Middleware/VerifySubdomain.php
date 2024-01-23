<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = explode('.', $request->getHost());
        $currentTenant = auth()->user()->current_tenant_id;
        $tenantDomain = Tenant::find($currentTenant)->subdomain;
        if (count($host) >= 3 && $host[0] !== $tenantDomain) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
