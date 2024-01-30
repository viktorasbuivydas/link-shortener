<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinksTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_link_can_be_created(): void
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

    public function test_link_can_be_retrieved(): void
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

        $response = $this->get('/links/' . $response->json('data.hash'));

        $response->assertStatus(302)
            ->assertRedirect($url);
    }
}
