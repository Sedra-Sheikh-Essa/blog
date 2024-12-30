@extends('layouts.app')
@section('title', 'add category')
@section('content')
    <div class="container mt-5">
        <h1>Add New Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
    </div>
@endsection
