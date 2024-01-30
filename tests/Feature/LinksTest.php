<?php

namespace Tests\Feature;

use App\Models\Link;
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

        $response->assertRedirect(route('links.index'))
            ->assertSessionHas('success', 'Link created successfully.');


        $this->assertDatabaseHas('links', [
            'url' => $url,
        ]);
    }

    public function test_link_can_be_retrieved(): void
    {
        $link = Link::factory()->create();

        $this->get(route('links.show', $link))
        ->assertRedirect($link->url);
    }
}
