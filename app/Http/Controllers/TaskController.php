<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Task\TaskDTO;
use App\Http\Requests\TaskRequest;
use App\Models\{Label, Task, TaskStatus, User};
use App\Services\TaskManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function __construct(private TaskManager $taskManager)
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(): View
    {
        $tasks = Task::paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id')->sortKeys();
        $assignees = User::all()->pluck('name', 'id')->sort();
        $labels = Label::all()->pluck('name', 'id')->sort();

        return view('tasks.create', compact('taskStatuses', 'assignees', 'labels'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $taskDTO = TaskDTO::fromRequest($request);

        $task = $this->taskManager->create($taskDTO);

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
        $taskStatuses = TaskStatus::all()->pluck('name', 'id')->sortKeys();
        $assignees = User::all()->pluck('name', 'id')->sort();
        $labels = Label::all()->pluck('name', 'id')->sort();

        return view('tasks.edit', compact('task', 'taskStatuses', 'assignees', 'labels'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $taskDTO = TaskDTO::fromRequest($request);

        $task = $this->taskManager->update($task, $taskDTO);

        if ($task->save()) {
            flash()->success(__('layout.flash.task.updated'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        if ($task->delete()) {
            flash()->success(__('layout.flash.task.deleted'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('tasks.index');
    }
}
