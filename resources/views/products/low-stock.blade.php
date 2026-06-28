@extends('layouts.pharma')

@section('content')
<div class="space-y-6 p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-error/5 border border-error/20 p-5 rounded-2xl">
        <div class="flex items-start gap-3">
            <div class="p-3 bg-error/10 text-error rounded-xl shrink-0">
                <span class="material-symbols-outlined text-[28px] animate-pulse">warning</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white flex items-center gap-2">
                    Low Stock Alerts
                </h1>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                    The following medical products have dropped below their minimum safe stock thresholds. Please reorder soon.
                </p>
            </div>
        </div>
        
        <div class="bg-surface-container dark:bg-neutral-800/60 px-4 py-2.5 rounded-xl border border-outline-variant/30 text-center sm:text-right">
            <span class="text-xs text-on-surface-variant dark:text-gray-400 block font-medium">Critical Items</span>
            <span class="text-lg font-black text-error font-mono">{{ $products->count() }} Products</span>
        </div>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
                        <th class="px-6 py-4">Product Details</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Minimum Required</th>
                        <th class="px-6 py-4">Current Stock</th>
                        <th class="px-6 py-4">Status / Deficit</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                    @forelse ($products as $product)
                        <tr class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-base text-on-surface dark:text-white">{{ $product->name }}</div>
                                @if($product->scientific_name)
                                    <div class="text-xs text-on-surface-variant dark:text-gray-400 italic mt-0.5">{{ $product->scientific_name }}</div>
                                @endif
                                @if($product->sku)
                                    <div class="text-[11px] font-mono text-gray-400 mt-1">SKU: {{ $product->sku }}</div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-secondary/10 text-secondary border border-secondary/20">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 font-mono font-medium text-on-surface-variant dark:text-gray-400">
                                {{ $product->minimum_stock }} units
                            </td>

                            <td class="px-6 py-4 font-mono">
                                @if($product->stock_quantity <= 0)
                                    <span class="text-red-600 dark:text-red-400 font-black text-base bg-red-50 dark:bg-red-950/30 px-2 py-1 rounded">0</span>
                                @else
                                    <span class="text-amber-600 dark:text-amber-400 font-bold text-base bg-amber-50 dark:bg-amber-950/30 px-2 py-1 rounded">
                                        {{ $product->stock_quantity }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if($product->stock_quantity <= 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-950/50 dark:text-red-400">
                                        Completely Out
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-400">
                                        Short by {{ $product->minimum_stock - $product->stock_quantity }} units
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-semibold bg-primary text-white hover:bg-primary/90 px-3 py-1.5 rounded-lg shadow-sm transition-all"
                                   title="Restock or Edit">
                                    <span class="material-symbols-outlined text-[16px]">local_shipping</span>
                                    <span>Restock</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-on-surface-variant dark:text-gray-500">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <span class="material-symbols-outlined text-5xl text-success animate-bounce">check_circle</span>
                                    <p class="text-base font-medium text-on-surface dark:text-white">All stock levels are safe!</p>
                                    <p class="text-xs max-w-xs mx-auto">No medical inventory items are currently running below their defined limits.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- دعم الترقيم في حال كانت المنتجات كثيرة جداً --}}
        @if(method_exists($products, 'links') && $products->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection