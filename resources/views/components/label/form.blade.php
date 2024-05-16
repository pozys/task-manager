<x-forms.entity>
    <h1 class="mb-5">{{ $title }}</h1>

    {{ html()->modelForm($label ?? null, $method, $action)->open() }}
    <div class="flex flex-col">
        <div>
            {{ html()->label( __('label.name'), 'name') }}
        </div>
        <div class="mt-2">
            {{ html()->text('name')->class('rounded border-gray-300 w-1/3') }}
            @error('name')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ html()->label( __('label.description'), 'description') }}
        </div>
        <div>
            {{ html()->textarea('description')->class('rounded border-gray-300 w-1/3 h-32')
            ->attributes(['cols' => 50, 'rows' => 10]) }}
            @error('description')
            <x-forms.validation :$message />
            @enderror
        </div>
        <div class="mt-2">
            {{ $submit }}
        </div>
    </div>
    {{ html()->closeModelForm() }}
</x-forms.entity>
