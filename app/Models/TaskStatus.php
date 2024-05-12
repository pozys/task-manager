<?php

namespace App\Models;

use App\Exceptions\TaskStatus\TaskStatusInUseException;
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

    protected static function booted(): void
    {
        static::deleting(function (TaskStatus $status) {
            $status->loadExists('tasks');
            if ($status->tasks_exists) {
                throw new TaskStatusInUseException("The status $status->name is used in tasks and cannot be deleted.");
            }
        });
    }
}
