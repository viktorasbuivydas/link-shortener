<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UrlLookupService
{
    public function checkUrl(string $url): array
    {
        if (app()->environment('testing')) {
            return [];
        }

        try {
            // guzzle post
            $request = Http::post('https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . config('services.url_lookup.key'), [
                'client' => [
                    'clientId' => 'laravel-url-shortener',
                    'clientVersion' => '1.0.0',
                ],
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url],
                    ],
                ],
            ]);

            return $request->json();
        } catch (\Exception $e) {
            throw new \Exception('An error occurred while checking the URL.');
        }
    }
}
