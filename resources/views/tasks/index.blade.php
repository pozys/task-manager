<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                @include('flash::message')
                <h1 class="mb-5">{{ __('task.index.title') }}</h1>

                @can('create', App\Models\Task::class)
                <div class="w-full flex items-center">
                    <div class="ml-auto">
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            {{ __('task.index.create') }}</a>
                    </div>
                </div>
                @endcan

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('task.id') }}</th>
                            <th>{{ __('task.status') }}</th>
                            <th>{{ __('task.name') }}</th>
                            <th>{{ __('task.created_by') }}</th>
                            <th>{{ __('task.assigned_to') }}</th>
                            <th>{{ __('task.created_at') }}</th>
                            <th>{{ __('task.index.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td>
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $task->author->name }}</td>
                            <td>{{ $task->assignee->name }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            <td>
                                @can('delete', $task)
                                <a data-confirm="{{ __('task.index.sure') }}" data-method="delete"
                                    href="{{ route('tasks.destroy', $task) }}" class="text-red-600 hover:text-red-900">
                                    {{ __('task.index.delete') }} </a>
                                @endcan
                                @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('task.index.update') }} </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
