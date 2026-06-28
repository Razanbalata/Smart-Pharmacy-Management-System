@extends('layouts.pharma')

@section('content')
<div class="max-w-2xl mx-auto p-6 space-y-6">
    
    <div class="flex items-center gap-3">
        <div class="p-3 bg-primary/10 text-primary rounded-xl">
            <span class="material-symbols-outlined text-[28px]">published_with_changes</span>
        </div>
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Adjust Inventory Stock</h1>
            <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-0.5">Manually reconcile and balance pharmacy item quantities.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 bg-success/10 border border-success/20 text-success p-4 rounded-xl shadow-sm">
            <span class="material-symbols-outlined text-[22px]">check_circle</span>
            <div class="text-sm font-semibold">{{ session('success') }}</div>
        </div>
    @endif

    <div class="bg-surface-container-low dark:bg-neutral-900/30 p-6 rounded-2xl border border-outline-variant/40 shadow-sm">
        <form method="POST" action="{{ route('stock.adjust') }}" class="space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label class="text-xs font-bold tracking-wider text-on-surface-variant dark:text-gray-300 uppercase block">
                    Select Product
                </label>
                <div class="relative">
                    <select name="product_id" class="w-full pl-4 pr-10 py-2.5 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} (Available: {{ $product->stock_quantity ?? $product->current_stock }} units)
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold tracking-wider text-on-surface-variant dark:text-gray-300 uppercase block">
                    New Quantity
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-on-surface-variant/70">
                        <span class="material-symbols-outlined text-[18px]">dialpad</span>
                    </span>
                    <input 
                        type="number" 
                        name="quantity" 
                        required
                        placeholder="e.g. 150" 
                        class="w-full pl-11 pr-4 py-2.5 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-mono"
                    >
                </div>
                <p class="text-[11px] text-on-surface-variant/70 dark:text-gray-400">Enter the exact absolute number counted during inventory auditing.</p>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold tracking-wider text-on-surface-variant dark:text-gray-300 uppercase block">
                    Reason for Adjustment
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-on-surface-variant/70">
                        <span class="material-symbols-outlined text-[18px]">edit_note</span>
                    </span>
                    <input 
                        type="text" 
                        name="reason" 
                        required
                        placeholder="e.g. Manual inventory count discrepancy, Expired batch removal" 
                        class="w-full pl-11 pr-4 py-2.5 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                    >
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-outline-variant/20">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 text-sm cursor-pointer">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Save Adjustment</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection