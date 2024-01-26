<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use FilterByTenant;

    protected $fillable = ['name', 'project_id'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
