<?php

namespace App\Models;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use FilterByUser;
    protected $fillable = ['name', 'user_id'];


    public function task(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
