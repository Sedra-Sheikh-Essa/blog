@extends('layouts.app')
@section('title', 'categories')
@section('content')
    <div class="container mt-5">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary my-3">Add New Category</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="50"></td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-info px-4 py-2">edit
                                category</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-3 py-2">delete category</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
