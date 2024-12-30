<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $posts = Post::with('user', 'category', 'tags', 'comments')->latest()->get();
        return view('posts.index', compact('posts'));
    }
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
/*          'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id', */
            'image' => 'image|nullable|max:1999',
            'tags' => 'array',
        ]);

        if ($request->hasFile("image")) {
            $imageName = $request->file('image')->getClientOriginalName() . "-" . time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path("/images/posts"), $imageName);
    }
        $post=Post::create([
            "title" => $request->title,
            "content" => $request->content,
            "user_id" => Auth::id(),
            "category_id" => $request->category_id,
            "date" => today(),
            "image" => $imageName ,
        ]);
    $post->tags()->sync($request->tags);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user', 'category', 'tags', 'comments.user');
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.edit", compact('post', 'categories' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
/*          'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date|date_format:Y-m-d', */
            'image' => 'image|nullable|max:1999',
            'tags' => 'array',
        ]);

        if ($request->hasFile("image")) {
            $imageName = $request->file('image')->getClientOriginalName() . "-" . time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path("/images/posts"), $imageName);
        }else {
            $imageName = $post->image;
        }

        $post->update([
            "title" => $request->title,
            "content" => $request->content,
/*          "user_id" => Auth::id(),
 */         "category_id" => $request->category_id,
            "date" => today(),
            "image" => $imageName ,
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route("posts.index");
    }
}
