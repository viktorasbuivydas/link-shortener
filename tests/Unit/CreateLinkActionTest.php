<?php

namespace Tests\Unit;

use App\Actions\Link\CreateLink;
use Tests\TestCase;

class CreateLinkActionTest extends TestCase
{
    public function test_it_creates_a_link()
    {
        $url = 'https://example.com';

        $link = app(CreateLink::class)->execute($url);

        $this->assertDatabaseHas('links', [
            'url' => $url,
        ]);
    }
}
