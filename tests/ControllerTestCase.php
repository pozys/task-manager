<?php

namespace Tests;

use App\Models\User;

abstract class ControllerTestCase extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->user = $user;
    }
}
