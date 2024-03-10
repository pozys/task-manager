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
        $response->assertSee(__('task-status.index.id'));
        $response->assertSee(__('task-status.index.name'));
        $response->assertSee(__('task-status.index.created_at'));
    }

    public function testCreate(): void
    {
        $status = TaskStatus::factory()->make();
        $statusData = $status->only(['name']);
        $response = $this->post(route('task_statuses.store'), $statusData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $statusData);
    }

    public function testUpdate(): void
    {
        $status = $this->createStatus();
        $statusParams = ['name' => $this->faker->name];

        $response = $this->put(route('task_statuses.update', ['task_status' => $status]), $statusParams);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', array_merge(['id' => $status->id], $statusParams));
    }

    public function testDestroy(): void
    {
        $status = $this->createStatus();

        $response = $this->delete(
            route('task_statuses.destroy', ['task_status' => $status->id])
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted($status);
    }

    private function createStatus(): TaskStatus
    {
        return TaskStatus::factory()->create();
    }
}
