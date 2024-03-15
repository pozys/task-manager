<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                @include('flash::message')
                <h1 class="mb-5">{{ __('task-status.index.title') }}</h1>

                <div>
                    @auth
                    <a href="{{ route('task_statuses.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{
                        __('task-status.index.create') }}</a>
                    @endauth
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('task-status.index.id') }}</th>
                            <th>{{ __('task-status.name') }}</th>
                            <th>{{ __('task-status.index.created_at') }}</th>
                            <th>{{ __('task-status.index.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $status)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            <td>
                                @auth
                                <a data-confirm="{{ __('task-status.index.sure') }}" data-method="delete" rel="nofollow"
                                    class="text-red-600 hover:text-red-900"
                                    href="{{ route('task_statuses.destroy', $status->id) }}">{{
                                    __('task-status.index.delete') }}</a>
                                <a class="text-blue-600 hover:text-blue-900"
                                    href="{{ route('task_statuses.edit', $status->id) }}">{{
                                    __('task-status.index.update') }}</a>
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
