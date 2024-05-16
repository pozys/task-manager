<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\{Task, TaskStatus};
use Tests\ControllerTestCase;

class TaskTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertSee(__('task.id'));
        $response->assertSee(__('task.status'));
        $response->assertSee(__('task.name'));
        $response->assertSee(__('task.created_by'));
        $response->assertSee(__('task.assigned_to'));
        $response->assertSee(__('task.created_at'));
        $response->assertSee(__('task.index.actions'));
    }

    public function testCreate(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $taskData = [
            'name' => 'Test Task',
            'description' => 'This is a test task',
            'task_status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectToRoute('tasks.index');

        $this->assertDatabaseHas('tasks', $taskData);
    }

    public function testEdit(): void
    {
        $task = $this->createTask();

        $response = $this->get(route('tasks.edit', $task));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $task = $this->createTask();
        $taskParams = $task->only($task->getFillable());
        $taskParams['name'] = $this->faker->name;

        $response = $this->put(route('tasks.update', compact('task')), $taskParams);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectToRoute('tasks.index');

        $this->assertDatabaseHas('tasks', array_merge(['id' => $task->id], $taskParams));
    }

    public function testDestroy(): void
    {
        $task = $this->createTask();

        $response = $this->delete(
            route('tasks.destroy', compact('task'))
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirectToRoute('tasks.index');

        $this->assertSoftDeleted($task);
    }

    private function createTask(): Task
    {
        return Task::factory()->create([
            'created_by_id' => $this->user->id,
        ]);
    }
}
