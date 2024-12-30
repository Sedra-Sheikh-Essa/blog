@extends('layouts.app')
@section('title', 'add tag')
@section('content')
<div class="container mt-5">
    <h1>Add New Tag</h1>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="word" class="form-label">Name:</label>
            <input type="text" name="word" id="word" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Tag</button>
    </form>
</div>
@endsection
