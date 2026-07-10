@extends('layouts.pharma')

@section('content')
    <div class="max-w-7xl mx-auto p-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <div class="p-3 rounded-xl bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-[30px]">
                        point_of_sale
                    </span>
                </div>

                <div>
                    <h1 class="text-2xl font-bold">
                        Sales Orders
                    </h1>

                    <p class="text-sm text-gray-500">
                        Manage pharmacy sales invoices.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openAI('sales')"
                    class="relative group overflow-hidden inline-flex items-center gap-2.5 px-5 py-3.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm shadow-[0_4px_20px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_4px_25px_rgba(79,70,229,0.6)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">

                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>

                    <span
                        class="material-symbols-outlined text-[18px] tracking-normal group-hover:rotate-12 transition-transform duration-300">smart_toy</span>

                    <span>AI Analysis</span>
                </button>
                <a href="{{ route('sales.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-white hover:bg-primary/90 transition">
                    <span class="material-symbols-outlined">add</span>
                    New Sale
                </a>
            </div>

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif


        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">
                            Invoice
                        </th>

                        <th class="text-left p-4">
                            Cashier
                        </th>

                        <th class="text-left p-4">
                            Total
                        </th>

                        <th class="text-left p-4">
                            Status
                        </th>

                        <th class="text-left p-4">
                            Date
                        </th>

                        <th class="text-center p-4">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($sales as $sale)
                        <tr id="sale-{{ $sale->id }}"
                            class="
hover:bg-surface-container-lowest 
dark:hover:bg-neutral-800/20 
transition-all 
duration-300

@if (request('highlight') == $sale->id) bg-primary/10
ring-2
ring-primary
shadow-lg @endif
">

                            <td class="p-4 font-semibold">
                                #{{ $sale->id }}
                            </td>

                            <td class="p-4">
                                {{ $sale->user->name }}
                            </td>

                            <td class="p-4">
                                {{ number_format($sale->total, 2) }} JD
                            </td>

                            <td class="p-4">

                                @if ($sale->status == 'draft')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                        Draft
                                    </span>
                                @elseif($sale->status == 'completed')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                        Completed
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                        Cancelled
                                    </span>
                                @endif

                            </td>

                            <td class="p-4">
                                {{ $sale->created_at->format('Y-m-d') }}
                            </td>

                            <td class="p-4 text-center">

                                <a href="{{ route('sales.edit', $sale) }}"
                                    class="inline-flex items-center gap-1 text-primary hover:underline">

                                    <span class="material-symbols-outlined text-[18px]">
                                        edit
                                    </span>

                                    Open

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-8 text-gray-500">

                                No sales found.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>
            @if (method_exists($sales, 'links') && $sales->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                    {{ $sales->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const highlightId = "{{ request('highlight') }}";
            if (highlightId) {
                const row = document.getElementById(`sale-${highlightId}`);
                if (row) {
                    row.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        });
    @endsection
