<?php

namespace App\Policies;

use App\Models\{Task, User};
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(): bool
    {
        return Auth::check();
    }

    public function create(): bool
    {
        return Auth::check();
    }

    public function update(): bool
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task): bool
    {
        return $task->created_by_id === $user->id;
    }

    public function forceDelete(): bool
    {
        return false;
    }
}
