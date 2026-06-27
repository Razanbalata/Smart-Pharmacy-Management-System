@extends('layouts.pharma')

@section('content')
    <h1>Add Category</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Category Name">

        <textarea name="description" placeholder="Description"></textarea>

        <button type="submit">Save</button>
    </form>
@endsection
