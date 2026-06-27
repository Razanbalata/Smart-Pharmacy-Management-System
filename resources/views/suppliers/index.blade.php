@extends('layouts.pharma')

@section('content')

<h1>Suppliers</h1>

<a href="{{ route('suppliers.create') }}">+ Add Supplier</a>

@foreach($suppliers as $supplier)
    <div>
        <h3>{{ $supplier->name }}</h3>
        <p>{{ $supplier->phone }}</p>

        <a href="{{ route('suppliers.edit', $supplier->id) }}">Edit</a>

        <form method="POST" action="{{ route('suppliers.destroy', $supplier->id) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    </div>
@endforeach

@endsection