<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test status.
     *
     * @return void
     */
    public function test_status()
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(200);
    }
}
