<?php

namespace App\Models;

use App\Traits\FilterByTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use FilterByTenant;

    protected $fillable = ['name', 'user_id'];


    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
