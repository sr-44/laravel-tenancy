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
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = explode('.', $request->getHost());
        if (!auth()->guest()) {
            $user = auth()->user();
            $tenantDomains = $user->tenants->pluck('subdomain');
            // if in request exist subdomain and subdomain not in tenant domains
            if (count($host) >= 3) {
                if (!$tenantDomains->contains($host[0])) {
                    abort(403, 'Unauthorized action.');
                }
                $tenant = Tenant::where('subdomain', $host[0])->first();
                $user->update(['current_tenant_id' => $tenant->id]);
            }


        }

        return $next($request);
    }
}
