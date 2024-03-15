<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        //
    }

    public function store(TaskRequest $request)
    {
        //
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
