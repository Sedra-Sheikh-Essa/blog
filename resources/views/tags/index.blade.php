@extends('layouts.app')
@section('title', 'tags')
@section('content')
<div class="container mt-5">
    <h1>Tags</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary my-3">Add New Tag</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Buttons</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->word }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-info px-4 py-2 mb-2">edit tag</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-3 py-2">delete tag</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
