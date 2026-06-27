@extends('layouts.pharma')

@section('content')
<div class="space-y-6 p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Product Inventory</h1>
            <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Monitor stock levels, tracking barcodes, expirations, and supplier distributions.</p>
        </div>
        <div>
            <a href="{{ route('products.create') }}" 
               class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-4 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                <span>Add New Product</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-primary/10 text-primary rounded-lg">
                <span class="material-symbols-outlined">inventory_2</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Total Products</p>
                <p class="text-xl font-bold text-on-surface dark:text-white">{{ $products->count() }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-error/10 text-error rounded-lg">
                <span class="material-symbols-outlined">production_quantity_limits</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Low Stock Alert</p>
                <p class="text-xl font-bold text-error">{{ $products->where('stock_quantity', '<=', 10)->count() }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-secondary/10 text-secondary rounded-lg">
                <span class="material-symbols-outlined">category</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Categories</p>
                <p class="text-xl font-bold text-on-surface dark:text-white">{{ $products->pluck('category_id')->unique()->count() }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-success/10 text-success rounded-lg">
                <span class="material-symbols-outlined">verified</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Active Items</p>
                <p class="text-xl font-bold text-success">{{ $products->where('status', 'active')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
                        <th class="px-6 py-4">Product Name</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Supplier</th>
                        <th class="px-6 py-4">Pricing (Buy/Sell)</th>
                        <th class="px-6 py-4">Stock Qty</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                    @forelse($products as $product)
                        <tr class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-base text-on-surface dark:text-white">{{ $product->name }}</div>
                                @if($product->scientific_name)
                                    <div class="text-xs text-on-surface-variant dark:text-gray-400 italic mt-0.5">{{ $product->scientific_name }}</div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-secondary/10 text-secondary border border-secondary/20">
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-on-surface-variant dark:text-gray-400">
                                {{ $product->supplier->name }}
                            </td>

                            <td class="px-6 py-4 font-mono">
                                <span class="text-xs text-gray-400">${{ number_format($product->purchase_price, 2) }}</span>
                                <span class="mx-1 text-outline">→</span>
                                <span class="font-bold text-primary dark:text-primary-light">${{ number_format($product->selling_price, 2) }}</span>
                            </td>

                            <td class="px-6 py-4">
                                @if($product->stock_quantity <= 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-950/40 dark:text-red-400">
                                        Out of Stock
                                    </span>
                                @elseif($product->stock_quantity <= $product->minimum_stock)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400" title="Below minimum stock fallback threshold">
                                        Low: {{ $product->stock_quantity }} units
                                    </span>
                                @else
                                    <span class="font-bold font-mono text-on-surface dark:text-white">
                                        {{ $product->stock_quantity }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.edit', $product) }}" 
                                       class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                       title="Edit Product">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to archive this medication product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors"
                                                title="Delete Product">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                <span class="material-symbols-outlined text-4xl block mb-2">production_quantity_limits</span>
                                No medical inventory items found matching current filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection