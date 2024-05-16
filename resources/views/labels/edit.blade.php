<x-label.form method='PUT' :action="route('labels.update', $label)" :title="__('label.edit.title')" :$label>
    <x-slot:submit>
        <x-forms.submit :text="__('label.edit.submit')" />
        </x-slot>
</x-label.form>
