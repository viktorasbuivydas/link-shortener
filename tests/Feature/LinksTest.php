<?php

namespace Tests\Feature;

use App\Models\Link;
use Carbon\Carbon;
use Tests\TestCase;

class LinksTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_link_can_be_created(): void
    {
        $url = 'https://www.google.com';

        $response = $this->post('/api/links/create', [
            'url' => $url,
        ]);

        $link = Link::first();

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $link->id,
                    'url' => $link->url,
                    'hash' => $link->hash,
                    'short_url' => $link->short_url,
                ],
            ]);


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
