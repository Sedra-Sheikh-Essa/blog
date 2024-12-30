<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAdmin', User::class);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile("image")) {
            $imageName = $request->file('image')->getClientOriginalName() . "-" . time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path("/images/posts"), $imageName);
    }
        Category::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Category $category)
{
    $this->authorize('isAdmin', User::class);

    return view('categories.edit', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('isAdmin', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile("image")) {
            $imageName = $request->file('image')->getClientOriginalName() . "-" . time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path("/images/posts"), $imageName);
    }

        $category->update([
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('isAdmin', User::class);

        $category->delete();
        return redirect()->route('categories.index');
    }
}
