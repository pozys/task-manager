<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                @include('flash::message')
                <h1 class="mb-5">{{ __('label.index.title') }}</h1>

                <div>
                    @auth
                    <a href="{{ route('labels.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{
                        __('label.index.create') }}</a>
                    @endauth
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('label.id') }}</th>
                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.description') }}</th>
                            <th>{{ __('label.created_at') }}</th>
                            <th>{{ __('label.index.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labels as $label)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            <td>
                                @auth
                                <a data-confirm="{{ __('label.index.sure') }}" data-method="delete" rel="nofollow"
                                    class="text-red-600 hover:text-red-900"
                                    href="{{ route('labels.destroy', $label->id) }}">{{
                                    __('label.index.delete') }}</a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="{{ route('labels.edit', $label->id) }}">{{
                                    __('label.index.update') }}</a>
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
