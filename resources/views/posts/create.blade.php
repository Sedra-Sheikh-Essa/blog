@extends('layouts.app')
@section('title', 'add post')
@section('content')
    <div class="container mt-5">
        <h1>Create New Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="post title" required>
            </div>

            <div class="mb-3">
                <input name="image" class="form-control" type="file">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->word }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="send" class="btn btn-success">
        </form>
    </div>
@endsection
