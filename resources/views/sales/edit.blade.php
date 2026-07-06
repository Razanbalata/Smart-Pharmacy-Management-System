
@extends('layouts.pharma')

@section('content')
    {{-- إضافة خلفية خفيفة لكامل الصفحة لزيادة التباين --}}
    <div class="min-h-screen bg-gray-50/50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-5 border-b border-gray-200">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Sale Invoice <span class="text-indigo-600">#{{ $sale->id }}</span>
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Add products and complete the sale transaction efficiently.
                    </p>
                </div>

                <a href="{{ route('sales.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl shadow-sm hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to List
                </a>
            </div>

            {{-- Success Notification --}}
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Errors Notification --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 list-disc pl-5 text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Left Side: Actions & Table --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- كروت الفورم والجدول يفضل أن تحتوي على خلفية بيضاء وظل خفيف داخل ملفات الـ partials لتتناسق مع التصميم --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-1">
                        @include('sales.partials.add-item-form')
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-1">
                        @include('sales.partials.items-table')
                    </div>
                </div>

                {{-- Right Side: Sale Summary Card --}}
                <div class="sticky top-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
                        
                        <div class="border-b border-gray-100 pb-4">
                            <h2 class="font-bold text-lg text-gray-900">
                                Sale Summary
                            </h2>
                        </div>

                        {{-- Metadata Info --}}
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center text-gray-500">
                                <span>Status</span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $sale->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center text-gray-500">
                                <span>Cashier</span>
                                <span class="font-semibold text-gray-800">
                                    {{ $sale->user->name }}
                                </span>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- Financial Calculations --}}
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-medium text-gray-900">
                                    {{ number_format($sale->subtotal, 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-600">
                                <span>Discount</span>
                                <span class="font-medium text-red-600">
                                    -{{ number_format($sale->discount, 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between items-baseline pt-3 text-gray-900 border-t border-dashed border-gray-200">
                                <span class="text-base font-bold">Total Amount</span>
                                <span class="text-2xl font-black text-indigo-600">
                                    {{ number_format($sale->total, 2) }} <span class="text-sm font-bold text-gray-500">JD</span>
                                </span>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- Action Buttons --}}
                        <div class="space-y-3 pt-2">
                            {{-- Complete Button --}}
                            <form method="POST" action="{{ route('sales.complete', $sale) }}">
                                @csrf
                                <button class="w-full inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-semibold rounded-xl py-3 px-4 shadow-sm hover:shadow transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Complete Sale
                                </button>
                            </form>

                            {{-- Cancel Button --}}
                            <form method="POST" action="{{ route('sales.cancel', $sale) }}">
                                @csrf
                                <button class="w-full inline-flex items-center justify-center bg-white hover:bg-red-50 text-red-600 border border-gray-200 hover:border-red-200 font-medium rounded-xl py-2.5 px-4 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-14v4M1 7h22"></path></svg>
                                    Cancel Sale
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection