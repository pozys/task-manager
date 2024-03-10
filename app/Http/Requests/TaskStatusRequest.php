<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('task_statuses', 'name')->ignore($this->route('task_status')),
                'max:255'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('task-status.validation.unique'),
        ];
    }
}
