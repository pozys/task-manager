<?php

namespace Tests\Feature;

use App\Models\Label;
use Tests\ControllerTestCase;

class LabelTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
        $response->assertSee(__('label.index.title'));
        $response->assertSee(__('label.id'));
        $response->assertSee(__('label.name'));
        $response->assertSee(__('label.description'));
        $response->assertSee(__('label.created_at'));
        $response->assertSee(__('label.index.actions'));
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $labelData = [
            'name' => 'Test Label',
            'description' => 'This is a test label',
        ];

        $response = $this->post(route('labels.store'), $labelData);

        $response->assertRedirectToRoute('labels.index');
        $this->assertDatabaseHas('labels', $labelData);
    }

    public function testEdit(): void
    {
        $label = $this->createLabel();

        $response = $this->get(route('labels.edit', $label));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $label = $this->createLabel();

        $newLabelData = [
            'name' => 'Updated Label',
            'description' => 'This is an updated label',
        ];

        $response = $this->put(route('labels.update', compact('label')), $newLabelData);

        $response->assertRedirectToRoute('labels.index');
        $this->assertDatabaseHas('labels', $newLabelData);
    }

    public function testDestroy(): void
    {
        $label = $this->createLabel();

        $response = $this->delete(route('labels.destroy', compact('label')));

        $response->assertRedirectToRoute('labels.index');
        $this->assertSoftDeleted($label);
    }

    public function testDestroyDeniedWhenUsedByTask(): void
    {
        $label = Label::factory()
            ->hasTasks(1)
            ->create();

        $response = $this->delete(route('labels.destroy', compact('label')));
        $response->assertRedirectToRoute('labels.index');
        $this->assertNotSoftDeleted($label);
    }

    private function createLabel(): Label
    {
        return Label::factory()->create();
    }
}
