<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Post $post)
    {
/*     dd($request);
 */        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
/*           'user_id' => 'required|exists:users,id',
            'date' => 'required|date|date_format:Y-m-d', */
        ]);

            Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'date' => today(),
        ]);

        return redirect()->route('posts.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment, )
    {
        $this->authorize('UpdateComment', $comment);
        return view('comments.edit', compact('comment'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('UpdateComment', $comment);
        $request->validate([
            'content' => 'required|string',
/*             'post_id' => 'required|exists:posts,id',
 */        ]);

        $comment->update([
            'content' => $request->content,
/*             'post_id' => $request->post_id,
 */
    ]);

        return redirect()->route('posts.show', $comment->post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete2', $comment);
        $comment->delete();
        return redirect()->route('posts.show', $comment->post);
    }
}
