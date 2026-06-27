@extends('layouts.pharma')

@section('content')
    <h1>Edit Category</h1>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $category->name }}">

        <textarea name="description">{{ $category->description }}</textarea>

        <button type="submit">Update</button>
    </form>
@endsection
