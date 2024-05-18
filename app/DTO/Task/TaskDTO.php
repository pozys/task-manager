<?php

declare(strict_types=1);

namespace App\DTO\Task;

use App\Http\Requests\TaskRequest;

class TaskDTO
{
    public readonly array $labels;

    public static function fromRequest(TaskRequest $request): self
    {
        return new self(
            $request->name,
            (int) $request->task_status_id,
            $request->description,
            (int) $request->assigned_to_id,
            array_map('intval', $request->labels),
        );
    }

    public function __construct(
        public readonly string $name,
        public readonly int $taskStatusId,
        public readonly ?string $description,
        public readonly ?int $assignedToId,
        ?array $labels = null,
    ) {

        $this->labels = $labels ?? [];
    }
}
