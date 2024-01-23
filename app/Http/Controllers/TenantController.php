<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function changeTenant($tenantId)
    {
        $tenant = Tenant::findOrfail($tenantId);
        auth()->user()->update(['current_tenant_id' => $tenant->id]);

        return redirect()->route('dashboard');

    }
}
