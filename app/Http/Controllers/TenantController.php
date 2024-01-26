<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Providers\RouteServiceProvider;

class TenantController extends Controller
{
    public function changeTenant($tenantId)
    {
        $tenant = Tenant::findOrfail($tenantId);
        auth()->user()->update(['current_tenant_id' => $tenant->id]);

        $tenantDomain = str_replace('://','://' . $tenant->subdomain . '.' , config('app.url'));
        return redirect($tenantDomain . RouteServiceProvider::HOME);

    }
}
