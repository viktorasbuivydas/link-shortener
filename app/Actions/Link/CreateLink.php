<?php

namespace App\Actions\Link;

use App\Models\Link;
use App\Services\UrlLookupService;

class CreateLink
{
    public function execute(string $url): Link
    {
        $link = Link::whereUrl($url)->first();

        if ($link) {
            return $link;
        }

        $hash = $this->generateHash();
        $this->validateUrl($url);
        $response = $this->validateUrl($url);

        if (count($response) === 0) {
            $link = Link::create([
                'url' => $url,
                'hash' => $hash,
            ]);
        }

        return $link;
    }

    private function generateHash(): string
    {
        $hash = substr(md5(uniqid()), 0, 6);
        $link = Link::whereHash($hash)->first();

        if ($link) {
            return $this->generateHash();
        }

        return $hash;
    }


    private function validateUrl(string $url): array
    {
        return app(UrlLookupService::class)->checkUrl($url);
    }
}
