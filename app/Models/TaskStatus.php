<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
