<?php

namespace App\Models;

use App\Exceptions\Label\LabelInUseException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Label $label) {
            $label->loadExists('tasks');
            if ($label->tasks_exists) {
                throw new LabelInUseException("The label $label->name is used in tasks and cannot be deleted.");
            }
        });
    }
}
