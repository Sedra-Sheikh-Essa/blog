@extends('layouts.app')
@section('title', 'edit tag')
@section('content')
<div class="container mt-5">
    <h1>Edit Tag</h1>
    <form action="{{ route('tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="word" class="form-label fs-5">Name:</label>
            <input type="text" name="word" id="word" class="form-control" value="{{ $tag->word }}" required>
        </div>

        <input type="submit" value="update" class="btn btn-success">
    </form>
</div>
@endsection
