<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateLinkTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $url = 'https://www.google.com';

        $response = $this->post('/links/create', [
            'url' => $url,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'url' => $url,
                ],
            ]);

        $this->assertDatabaseHas('links', [
            'url' => $url,
        ]);
    }
}
