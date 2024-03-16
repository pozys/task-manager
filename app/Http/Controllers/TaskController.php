<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\{Task, TaskStatus, User};
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id')->sortKeys();
        $assignees = User::all()->pluck('name', 'id')->sort();

        return view('tasks.create', compact('taskStatuses', 'assignees'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = new Task($request->validated());
        $task->author()->associate(Auth::user());
        $task->save();

        if ($task) {
            flash()->success(__('layout.flash.task.created'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        //
    }

    public function update(TaskRequest $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        //
    }
}
