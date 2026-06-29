@extends('layouts.pharma')

@section('content')

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    Sale Invoice #{{ $sale->id }}
                </h1>

                <p class="text-sm text-gray-500">
                    Add products and complete the sale.
                </p>
            </div>

            <a href="{{ route('sales.index') }}" class="px-4 py-2 rounded-xl border">
                Back
            </a>

        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-xl">

                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Side --}}
            <div class="lg:col-span-2 space-y-6">

                @include('sales.partials.add-item-form')

                @include('sales.partials.items-table')

            </div>


            {{-- Right Side --}}
            <div>

                <div class="bg-white rounded-2xl shadow p-6 space-y-5">

                    <h2 class="font-bold text-lg">
                        Sale Summary
                    </h2>

                    <div class="flex justify-between">

                        <span>Status</span>

                        <span class="font-semibold">
                            {{ ucfirst($sale->status) }}
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Cashier</span>

                        <span class="font-semibold">

                            {{ auth()->user()->name }}

                        </span>

                    </div>

                    <hr>

                    <div class="flex justify-between">

                        <span>Subtotal</span>

                        <span>

                            {{ number_format($sale->subtotal, 2) }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Discount</span>

                        <span>

                            {{ number_format($sale->discount, 2) }}

                        </span>

                    </div>

                    <div class="flex justify-between text-lg font-bold">

                        <span>Total</span>

                        <span>

                            {{ number_format($sale->total, 2) }} JD

                        </span>

                    </div>

                    <hr>

                    {{-- Complete --}}

                    <form method="POST" action="{{ route('sales.complete', $sale) }}">

                        @csrf

                        <button class="w-full bg-green-600 hover:bg-green-700 text-white rounded-xl py-3">

                            Complete Sale

                        </button>

                    </form>

                    {{-- Cancel --}}

                    <form method="POST" action="{{ route('sales.cancel', $sale) }}">

                        @csrf

                        <button class="w-full bg-red-600 hover:bg-red-700 text-white rounded-xl py-3">

                            Cancel Sale

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
