@extends('layouts.pharma')

@section('content')
    <div class="space-y-6 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-1.5">
                    <span class="text-on-surface-variant">Inventory</span>
                    <span class="material-symbols-outlined text-sm select-none">chevron_right</span>
                    <span class="text-on-surface">Products List</span>
                </nav>
                <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Product Inventory</h1>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                    Monitor stock levels, tracking barcodes, expirations, and supplier distributions.
                </p>
            </div>
            <div>
               <button onclick="openAI('products')"
                    class="relative group overflow-hidden inline-flex items-center gap-2.5 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm shadow-[0_4px_20px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_4px_25px_rgba(79,70,229,0.6)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">

                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>

                    <span
                        class="material-symbols-outlined text-[18px] tracking-normal group-hover:rotate-12 transition-transform duration-300">smart_toy</span>

                    <span>AI Analysis</span>
                </button>
                <button onclick="window.dispatchEvent(new CustomEvent('open-pdf-preview', { detail: { type: 'products' } }))"
                    class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                    <span>Export PDF</span>
                </button>
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>

        <div
            class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-2xl border border-outline-variant/40 shadow-sm">
            <form method="GET" action="{{ route('products.index') }}"
                class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">

                <div class="relative sm:col-span-4">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-on-surface-variant/70">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or SKU..."
                        class="w-full pl-10 pr-4 py-2 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>

                <div class="relative sm:col-span-3">
                    <select name="category"
                        class="w-full pl-4 pr-10 py-2 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">expand_more</span>
                    </div>
                </div>

                <div class="relative sm:col-span-3">
                    <select name="supplier"
                        class="w-full pl-4 pr-10 py-2 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                        <option value="">All Suppliers</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ request('supplier') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[18px]">expand_more</span>
                    </div>
                </div>

                <div class="flex gap-2 sm:col-span-2 w-full">
                    <button type="submit"
                        class="flex-1 bg-gray-900 hover:bg-gray-800 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-white font-medium text-sm py-2 px-4 rounded-xl transition duration-150 shadow-sm flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        <span>Filter</span>
                    </button>

                    @if (request('search') || request('category') || request('supplier'))
                        <a href="{{ route('products.index') }}"
                            class="p-2 bg-error/10 text-error hover:bg-error/20 rounded-xl transition-colors flex items-center justify-center"
                            title="Clear Filters">
                            <span class="material-symbols-outlined text-[20px]">filter_alt_off</span>
                        </a>
                    @endif
                </div>

            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-primary/10 text-primary rounded-lg">
                    <span class="material-symbols-outlined">inventory_2</span>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400">Total Products</p>
                    <p class="text-xl font-bold text-on-surface dark:text-white">{{ $products->count() }}</p>
                </div>
            </div>
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-error/10 text-error rounded-lg">
                    <span class="material-symbols-outlined">production_quantity_limits</span>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400">Low Stock Alert</p>
                    <p class="text-xl font-bold text-error">{{ $products->where('stock_quantity', '<=', 10)->count() }}</p>
                </div>
            </div>
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-secondary/10 text-secondary rounded-lg">
                    <span class="material-symbols-outlined">category</span>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400">Categories</p>
                    <p class="text-xl font-bold text-on-surface dark:text-white">
                        {{ $products->pluck('category_id')->unique()->count() }}
                    </p>
                </div>
            </div>
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-success/10 text-success rounded-lg">
                    <span class="material-symbols-outlined">verified</span>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400">Active Items</p>
                    <p class="text-xl font-bold text-success">{{ $products->where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>

        <div
            class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                @if ($lowStockProducts->count() > 0)
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-error/10 border border-error/20 p-4 mb-6 rounded-2xl shadow-sm transition-all animate-pulse">
                        <div class="flex items-center gap-3 text-error">
                            <span class="material-symbols-outlined text-[24px]">warning</span>
                            <div class="text-sm font-semibold tracking-wide">
                                Low Stock Alert: <span
                                    class="font-bold font-mono bg-error/10 px-2 py-0.5 rounded-md">{{ $lowStockProducts->count() }}</span>
                                products need restocking urgently.
                            </div>
                        </div>
                        <div class="flex shrink-0">
                            <a href="{{ route('products.low-stock') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 bg-error hover:bg-error-container text-white hover:text-on-error-container text-xs font-bold px-4 py-2 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                <span>View Alert List</span>
                            </a>
                        </div>
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
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
                            <tr id="product-{{ $product->id }}"
                                class="
hover:bg-surface-container-lowest 
dark:hover:bg-neutral-800/20 
transition-all 
duration-300

@if (request('highlight') == $product->id) bg-primary/10
ring-2
ring-primary
shadow-lg @endif
">

                                <td class="px-6 py-4">
                                    <div class="font-semibold text-base text-on-surface dark:text-white">
                                        {{ $product->name }}</div>
                                    @if ($product->scientific_name)
                                        <div class="text-xs text-on-surface-variant dark:text-gray-400 italic mt-0.5">
                                            {{ $product->scientific_name }}</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-secondary/10 text-secondary border border-secondary/20">
                                        {{ $product->category->name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-on-surface-variant dark:text-gray-400">
                                    {{ $product->supplier->name }}
                                </td>

                                <td class="px-6 py-4 font-mono">
                                    <span
                                        class="text-xs text-gray-400">${{ number_format($product->purchase_price, 2) }}</span>
                                    <span class="mx-1 text-outline">→</span>
                                    <span
                                        class="font-bold text-primary dark:text-primary-light">${{ number_format($product->selling_price, 2) }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($product->stock_quantity <= 0)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-950/40 dark:text-red-400">
                                            Out of Stock
                                        </span>
                                    @elseif($product->stock_quantity <= $product->minimum_stock)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400"
                                            title="Below minimum stock fallback threshold">
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

                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to archive this medication product?')">
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
                                <td colspan="6"
                                    class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                    <span
                                        class="material-symbols-outlined text-4xl block mb-2">production_quantity_limits</span>
                                    No medical inventory items found matching current filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($products, 'links') && $products->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const highlighted = document.querySelector('[id^="product-"]');

            const params = new URLSearchParams(window.location.search);

            const id = params.get('highlight');


            if (id) {

                const row = document.getElementById(`product-${id}`);

                if (row) {

                    setTimeout(() => {

                        row.scrollIntoView({
                            behavior: "smooth",
                            block: "center"
                        });


                        row.classList.add(
                            "scale-[1.01]"
                        );


                        setTimeout(() => {

                            row.classList.remove(
                                "scale-[1.01]"
                            );

                        }, 1000);


                    }, 300);

                }

            }

        });
    </script>

    <style>
        .highlighted-row {
            animation: highlightPulse 2s ease-in-out infinite alternate;
        }

        @keyframes highlightPulse {
            0% {
                box-shadow: inset 0 0 4px rgba(var(--md-sys-color-primary-rgb), 0.1);
            }

            100% {
                box-shadow: inset 0 0 12px rgba(var(--md-sys-color-primary-rgb), 0.25);
            }
        }
    </style>
@endsection

@push('scripts')
    <x-pdf-preview-modal />
@endpush
