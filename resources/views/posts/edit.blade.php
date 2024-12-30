@extends('layouts.app')
@section('title', 'edit post')
@section('content')
    <div class="container mt-5">
        <h1>Edit {{ $post->title }} post Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input name="image" class="form-control" type="file">
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" alt="Current Image" class="img-thumbnail mt-2"
                        style="max-width: 150px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" disabled>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <select class="form-control" id="tags" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            {{ collect(old('tags', $post->tags->pluck('id')->toArray()))->contains($tag->id) ? 'selected' : '' }}>
                            {{ $tag->word }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="update" class="btn btn-success">
        </form>
    </div>
@endsection
