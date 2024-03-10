<x-app-layout>
    <x-task-status.form method='PUT' :action="route('task_statuses.update', $taskStatus)"
        :title="__('task-status.edit.title')" :$taskStatus>
        <x-slot:submit>
            <x-forms.submit :text="__('task-status.edit.submit')" />
            </x-slot>
    </x-task-status.form>
</x-app-layout>
