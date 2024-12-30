@extends('layouts.app')
@section('title', 'edit category')
@section('content')
<div class="container mt-5">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fs-5">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fs-5">Image</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ $category->image }}" required>
        </div>

        <button type="submit" class="btn btn-success">update</button>
    </form>
</div>
@endsection
