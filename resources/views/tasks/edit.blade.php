<x-task.form method='PUT' :action="route('tasks.update', $task)" :title="__('task.edit.title')" :$task :$taskStatuses
    :$assignees>
    <x-slot:submit>
        <x-forms.submit :text="__('task.edit.submit')" />
        </x-slot>
</x-task.form>
