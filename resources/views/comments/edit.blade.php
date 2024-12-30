@extends('layouts.app')
@section('title', 'comment')
@section('content')
    <div class="container mt-5">
        <h1>Edit Your Comment:</h1>
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea name="content" class="form-control my-4" rows="3" required>{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">update</button>
        </form>
    </div>
@endsection
