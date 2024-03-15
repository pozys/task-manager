<x-app-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                @include('flash::message')
                <h1 class="mb-5">{{ __('task.index.title') }}</h1>

                <div class="w-full flex items-center">
                    <div class="ml-auto">
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            {{ __('task.index.create') }}</a>
                    </div>
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                        <tr>
                            <th>{{ __('task.index.id') }}</th>
                            <th>{{ __('task.index.status') }}</th>
                            <th>{{ __('task.index.name') }}</th>
                            <th>{{ __('task.index.created_by') }}</th>
                            <th>{{ __('task.index.assigned_to') }}</th>
                            <th>{{ __('task.index.created_at') }}</th>
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
                                <a data-confirm="{{ __('task-status.index.sure') }}" data-method="delete"
                                    href="{{ route('tasks.destroy', $task) }}" class="text-red-600 hover:text-red-900">
                                    {{ __('task.index.delete') }} </a>
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ __('task.index.update') }} </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
