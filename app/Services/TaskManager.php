<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Task\TaskDTO;
use App\Models\Task;

class TaskManager
{
    public function create(TaskDTO $dto): Task
    {
        $task = Task::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'task_status_id' => $dto->taskStatusId,
            'assigned_to_id' => $dto->assignedToId,
        ]);

        $this->syncLabels($task, ...$dto->labels);

        return $task;
    }

    public function update(Task $task, TaskDTO $dto): Task
    {
        $task->name = $dto->name;
        $task->description = $dto->description;
        $task->task_status_id = $dto->taskStatusId;
        $task->assigned_to_id = $dto->assignedToId;
        $task->save();

        $this->syncLabels($task, ...$dto->labels);

        return $task;
    }

    private function syncLabels(Task $task, int ...$labels): void
    {
        $task->labels()->sync($labels);
    }
}
