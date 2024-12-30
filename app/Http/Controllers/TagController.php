<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAdmin', User::class);

        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        $request->validate([
            'word' => 'required|string|max:255',
        ]);

        Tag::create(['word' => $request->word]);

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('isAdmin', User::class);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('isAdmin', User::class);
        $request->validate([
            'word' => 'required|string|max:255',
        ]);

        $tag->update(['word' => $request->word]);

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('isAdmin', User::class);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
