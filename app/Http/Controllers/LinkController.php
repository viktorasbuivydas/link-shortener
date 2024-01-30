<?php

namespace App\Http\Controllers;

use App\Actions\Link\CreateLink;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return inertia('Links/Index');
    }

    public function show(Link $link)
    {
        return redirect()->away($link->url);
    }

    public function store(LinkRequest $request)
    {
        try {
            app(CreateLink::class)
                ->execute($request->input('url'));
        } catch (\Exception $e) {
            return redirect()
                ->route('links.index')
                ->with('error', 'An error occurred while creating the link.');
        }

        return redirect()
            ->route('links.index')
            ->with('success', 'Link created successfully.');
    }
}
