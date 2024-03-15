<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string'],
            'task_status_id' => ['required', 'integer', Rule::exists('task_statuses', 'id')],
            'created_by_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'assigned_to_id' => ['nullable', 'integer', Rule::exists('users', 'id')],
        ];
    }
}
