@extends('layouts.pharma')

@section('content')
<div class="space-y-6 print:space-y-4 print:p-0">
    
    <nav class="flex items-center gap-2 text-sm text-on-surface-variant font-medium print:hidden">
        <a href="{{ route('reports.index') }}" class="hover:text-primary transition-colors">Reports</a>
        <span class="material-symbols-outlined text-base select-none">chevron_right</span>
        <span class="text-on-surface">Inventory Report</span>
    </nav>

    <div class="flex items-center justify-between border-b border-outline-variant pb-4 print:hidden">
        <div>
            <h1 class="font-headline-md text-headline-md text-on-surface">Inventory Report</h1>
            <p class="text-sm text-on-surface-variant">Live pharmacy stock statement and asset valuation.</p>
        </div>
        <button onclick="window.print()" class="flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-full hover:bg-primary-container hover:text-on-primary-container shadow-md transition font-medium">
            <span class="material-symbols-outlined text-sm">download_df</span>
            <span>Export PDF / Print</span>
        </button>
    </div>

    <div class="hidden print:flex items-center justify-between border-b-2 border-black pb-4 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-black uppercase tracking-wider">Pharmacy Inventory Statement</h1>
            <p class="text-xs text-neutral-600">Generated on: {{ now()->format('Y-m-d H:i') }}</p>
        </div>
        <div class="text-right text-xs text-neutral-600">
            <p class="font-bold text-black">PharmaSystem Co.</p>
            <p>Confidential Internal Report</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 print:grid-cols-4 print:gap-2">
        <div class="p-5 rounded-2xl border border-outline-variant bg-surface-container-lowest print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-on-surface-variant font-medium uppercase tracking-wider print:text-neutral-700">Total Products</p>
            <h2 class="text-3xl font-bold text-on-surface mt-1 print:text-black">{{ number_format($productsCount) }}</h2>
        </div>

        <div class="p-5 rounded-2xl border border-outline-variant bg-surface-container-lowest print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-on-surface-variant font-medium uppercase tracking-wider print:text-neutral-700">Inventory Value</p>
            <h2 class="text-3xl font-bold text-on-surface mt-1 print:text-black">${{ number_format($stockValue, 2) }}</h2>
        </div>

        <div class="p-5 rounded-2xl border border-outline-variant bg-surface-container-lowest print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-amber-600 font-medium uppercase tracking-wider print:text-amber-800">Low Stock</p>
            <h2 class="text-3xl font-bold text-on-surface mt-1 print:text-black">{{ $lowStock }}</h2>
        </div>

        <div class="p-5 rounded-2xl border border-outline-variant bg-surface-container-lowest print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-error font-medium uppercase tracking-wider print:text-rose-800">Expired Items</p>
            <h2 class="text-3xl font-bold text-on-surface mt-1 print:text-black">{{ $expired }}</h2>
        </div>
    </div>

    <div class="hidden print:flex justify-between items-center mt-12 pt-8 border-t border-dashed border-neutral-400 text-xs text-neutral-600">
        <p>Prepared By: ___________________________</p>
        <p>Inventory Auditor Signature: ___________________________</p>
    </div>
</div>
@endsection