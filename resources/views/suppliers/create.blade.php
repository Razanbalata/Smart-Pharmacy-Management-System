@extends('layouts.pharma')

@section('content')

<h1>Add Supplier</h1>

<form method="POST" action="{{ route('suppliers.store') }}">
    @csrf

    <input name="name" placeholder="Name">
    <input name="phone" placeholder="Phone">
    <input name="email" placeholder="Email">

    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <button type="submit">Save</button>
</form>

@endsection