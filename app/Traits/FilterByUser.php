<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait FilterByUser
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($project) {
            $project->user_id = auth()->id();
        });

        self::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
