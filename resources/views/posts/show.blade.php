@extends('layouts.app')
@section('title', 'post')
@section('content')
    <div class="container mt-5">
        <h1>{{ $post->title }}</h1>
        <div class="d-flex align-items-center my-2">
            @if (filter_var($post->user->image, FILTER_VALIDATE_URL))
                <img src="{{ $post->user->image }}" name="image" alt="" class="img-fluid mb-2 me-2 rounded-circle"
                    style="width:50px; height:50px;" />
            @else
                <img src="/images/posts/{{ $post->user->image }}" name="image" alt="" class="img-fluid mb-2"
                    style="width:50px; height:50px;" />
            @endif

            <h5>By {{ $post->user->name }}</h5>
        </div>
        @if (filter_var($post->image, FILTER_VALIDATE_URL))
            <img src="{{ $post->image }}" class="img-fluid mb-2 rounded" alt=""
                style="width:100%; height:180px;" />
        @else
            <img src="/images/posts/{{ $post->image }}" class="img-fluid mb-2" alt=""
                style="width:100%; height:120px;" />
        @endif
        <p class="fs-5">{{ $post->content }}</p>
        <p class="fs-5"><span class="fw-bold">Category: </span>{{ $post->category->name }}</p>
        <p class="fs-5"><span class="fw-bold">Tags: </span>
        <ol class="list-group list-group-numbered">
            @foreach ($post->tags as $tag)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Tag:</div>
                        <span>{{ $tag->word }}</span>
                    </div>
                </li>
            @endforeach
        </ol>
        </p>

        <p class="fs-3"><span class="fw-bold">Comments: </span>
            @if ($post->comments->isEmpty())
                <p class="fs-5">no comment to show</p>
            @else
                <ul class="list-group">
                    @foreach ($post->comments as $comment)
                        <li class="list-group-item my-4">
                            <div class="d-flex align-items-center my-2">
                                {{ $comment->user->name }}:
                                @if (filter_var($comment->user->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $comment->user->image }}" class="img-fluid mb-2 ms-2 rounded-circle"
                                        alt="" style="width:50px; height:50px;">
                                @endif
                            </div>
                            <p class="fs-5">{{ $comment->content }}</p>
                            <div class="d-flex justify-content-start">
                                <form action="{{ route('comments.edit', $comment) }}" method="" class="ms-4">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="btn btn-info px-4 py-2">edit comment</button>
                                </form>
                                <form action="{{ route('comments.destroy', $comment) }}"
                                    method="post" class="ms-4">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="btn btn-danger px-3 py-2">delete comment</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

        <h4>To Add New Comment:</h4>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control my-4" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">send</button>
        </form>

        <div class="d-flex justify-content-center my-4">
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-info px-4 py-2">edit post</a>
            <form action="{{ route('posts.destroy', $post) }}" method="post" class="ms-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-3 py-2">delete post</button>
            </form>
            <a href="{{ route('posts.index') }}" class="btn btn-info btn-leg px-4 py-2 ms-4">go back</a>

        </div>
    </div>
@endsection
