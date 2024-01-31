<?php

namespace App\Http\Controllers\Api;

use App\Actions\Link\CreateLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(LinkRequest $request)
    {
        try {
            $link = app(CreateLink::class)
                ->execute($request->input('url'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the link.',
            ], 400);
        }

        // return link
        return new LinkResource($link);
    }
}
