<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterByTenant
{
    protected static function boot(): void
    {
        parent::boot();

        $currentTenantId = auth()->user()->current_tenant_id;
//        dd($currentTenantId);
        static::creating(function ($model) use ($currentTenantId) {
            $model->tenant_id = $currentTenantId;
        });

        self::addGlobalScope(function (Builder $builder) use ($currentTenantId) {
            $builder->where('tenant_id', $currentTenantId);
        });
    }
}
