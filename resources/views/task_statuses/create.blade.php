<x-app-layout>
    <x-task-status.form method='POST' :action="route('task_statuses.store')" :title="__('task-status.create.title')">
        <x-slot:submit>
            <x-forms.submit :text="__('task-status.create.submit')" />
            </x-slot>
    </x-task-status.form>
</x-app-layout>
