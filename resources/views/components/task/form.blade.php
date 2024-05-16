<x-forms.entity>
    <h1 class="mb-5">{{ $title }}</h1>

    {{ html()->modelForm($task ?? null, $method, $action)->open() }}
    <div class="flex flex-col">
        <div>
            {{ html()->label( __('task.name'), 'name') }}
        </div>
        <div class="mt-2">
            {{ html()->text('name')->class('rounded border-gray-300 w-1/3') }}
            @error('name')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ html()->label( __('task.description'), 'description') }}
        </div>
        <div>
            {{ html()->textarea('description')->class('rounded border-gray-300 w-1/3 h-32')
            ->attributes(['cols' => 50, 'rows' => 10]) }}
            @error('description')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ html()->label( __('task.status'), 'task_status_id') }}
        </div>
        <div>
            {{ html()->select('task_status_id', $taskStatuses)
            ->placeholder(__('views.task.status.placeholder'))
            ->class('rounded border-gray-300 w-1/3') }}
            @error('task_status_id')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ html()->label( __('task.assigned_to'), 'assigned_to_id') }}
        </div>
        <div>
            {{ html()->select('assigned_to_id', $assignees)
            ->placeholder(__('views.task.assignee.placeholder'))
            ->class('rounded border-gray-300 w-1/3') }}
            @error('assigned_to_id')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ html()->label( __('task.tags'), 'labels') }}
        </div>
        <div>
            {{ html()->select('labels[]', $labels)
            ->placeholder(__('views.task.labels.placeholder'))
            ->class('rounded border-gray-300 w-1/3')
            ->attribute('multiple', 'multiple') }}
            @error('labels')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ $submit }}
        </div>
    </div>
    {{ html()->closeModelForm() }}
</x-forms.entity>
