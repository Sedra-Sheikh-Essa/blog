@extends('layouts.app')
@section('title', 'posts')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1>Posts</h1>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">add new post</a>
                    <input type="submit" value="logout" class="btn btn-danger px-3">
                </form>
            </div>
            @if (Auth::check())
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <div class="card rounded mb-5" style="height:500px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                @if (filter_var($post->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $post->image }}" class="img-fluid mb-2 rounded" alt=""
                                        style="width:100%; height:180px;" />
                                @else
                                    <img src="/images/posts/{{ $post->image }}" class="img-fluid mb-2" alt=""
                                        style="width:100%; height:120px;" />
                                @endif
                                <p class="card-text">content {{ $post->content }}</p>
                                <div class="d-flex align-items-center">
                                        <img src="{{ $post->user->image }}" name="image" alt=""
                                            class="img-fluid mb-2 me-2 rounded-circle" style="width:50px; height:50px;" />
                                    <p>By {{ $post->user->name }}</p>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary mt-2">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
