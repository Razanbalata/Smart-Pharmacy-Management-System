@extends('layouts.pharma')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('categories.create') }}">+ Add Category</a>

    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->name }}

                <a href="{{ route('categories.edit', $category->id) }}">Edit</a>

                <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
