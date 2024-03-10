<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ $title }}</h1>

            {{ html()->modelForm($taskStatus ?? null, $method, $action)->open() }}
            <div class="flex flex-col">
                <div>
                    {{ html()->label( __('task-status.name'), 'name') }}
                </div>
                <div class="mt-2">
                    {{ html()->text('name')->class('rounded border-gray-300 w-1/3') }}
                    @error('name')
                    <x-forms.validation :$message />
                    @enderror
                </div>
                <div class="mt-2">
                    {{ $submit }}
                </div>
            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
</section>
