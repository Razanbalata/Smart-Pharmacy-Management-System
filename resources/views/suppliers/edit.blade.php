@extends('layouts.pharma')

@section('content')

<h1>Edit Supplier</h1>

<form method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $supplier->name }}">
    <input name="phone" value="{{ $supplier->phone }}">
    <input name="email" value="{{ $supplier->email }}">

    <select name="status">
        <option value="active" @selected($supplier->status=='active')>Active</option>
        <option value="inactive" @selected($supplier->status=='inactive')>Inactive</option>
    </select>

    <button>Update</button>
</form>

@endsection