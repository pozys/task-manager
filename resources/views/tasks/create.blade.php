<x-task.form method='POST' :action="route('tasks.store')" :title="__('task.create.title')" :$taskStatuses :$assignees
    :$availableLabels>
    <x-slot:submit>
        <x-forms.submit :text="__('task.create.submit')" />
        </x-slot>
</x-task.form>
