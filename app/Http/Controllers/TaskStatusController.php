<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    public function index(): View
    {
        $statuses = TaskStatus::all();

        return view('task_statuses.index', compact('statuses'));
    }

    public function create(): View
    {
        return view('task_statuses.create');
    }

    public function store(TaskStatusRequest $request): RedirectResponse
    {
        $taskStatus = TaskStatus::create($request->validated());

        if ($taskStatus) {
            flash()->success(__('layout.flash.task_status.created'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus = $taskStatus->fill($request->validated());

        if ($taskStatus->save()) {
            flash()->success(__('layout.flash.task_status.updated'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->delete()) {
            flash()->success(__('layout.flash.task_status.deleted'));
        } else {
            flash()->error(__('layout.flash.error'));
        }

        return redirect()->route('task_statuses.index');
    }
}
