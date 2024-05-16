<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TaskStatus;
use Tests\ControllerTestCase;

class TaskStatusTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user);
    }
    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
        $response->assertSee(__('task-status.id'));
        $response->assertSee(__('task-status.name'));
        $response->assertSee(__('task-status.created_at'));
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $statusData = [
            'name' => 'Test Status',
        ];

        $response = $this->post(route('task_statuses.store'), $statusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectToRoute('task_statuses.index');

        $this->assertDatabaseHas('task_statuses', $statusData);
    }

    public function testEdit(): void
    {
        $status = $this->createStatus();

        $response = $this->get(route('task_statuses.edit', $status));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $status = $this->createStatus();
        $statusParams = ['name' => $this->faker->name];

        $response = $this->put(route('task_statuses.update', ['task_status' => $status]), $statusParams);

        $response->assertSessionHasNoErrors();
        $response->assertRedirectToRoute('task_statuses.index');

        $this->assertDatabaseHas('task_statuses', array_merge(['id' => $status->id], $statusParams));
    }

    public function testDestroy(): void
    {
        $status = $this->createStatus();

        $response = $this->delete(
            route('task_statuses.destroy', ['task_status' => $status->id])
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirectToRoute('task_statuses.index');
        $this->assertSoftDeleted($status);
    }

    public function testDestroyDeniedWhenUsedByTask(): void
    {
        $status = TaskStatus::factory()
            ->hasTasks(1)
            ->create();

        $response = $this->delete(route('task_statuses.destroy', ['task_status' => $status->id]));
        $response->assertRedirectToRoute('task_statuses.index');
        $this->assertNotSoftDeleted($status);
    }

    private function createStatus(): TaskStatus
    {
        return TaskStatus::factory()->create();
    }
}
