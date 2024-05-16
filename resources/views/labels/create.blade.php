<x-label.form method='POST' :action="route('labels.store')" :title="__('label.create.title')">
    <x-slot:submit>
        <x-forms.submit :text="__('label.create.submit')" />
        </x-slot>
</x-label.form>
