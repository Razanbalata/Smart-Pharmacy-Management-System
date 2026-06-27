@extends('layouts.pharma')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Edit Product</h1>
        <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Update the details for "{{ $product->name }}".</p>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 p-6 shadow-sm">
        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <h3 class="text-sm font-semibold text-primary uppercase tracking-wider mb-4">1. Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="name" class="text-sm font-medium text-on-surface dark:text-gray-300">Commercial Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="e.g., Panadol Advance" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('name') border-error @enderror" required>
                        @error('name') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="scientific_name" class="text-sm font-medium text-on-surface dark:text-gray-300">Scientific Name</label>
                        <input type="text" id="scientific_name" name="scientific_name" value="{{ old('scientific_name', $product->scientific_name) }}" placeholder="e.g., Paracetamol" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label for="sku" class="text-sm font-medium text-on-surface dark:text-gray-300">SKU (Internal Code) *</label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="PND-ADV-500" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('sku') border-error @enderror" required>
                        @error('sku') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="barcode" class="text-sm font-medium text-on-surface dark:text-gray-300">Barcode</label>
                        <input type="text" id="barcode" name="barcode" value="{{ old('barcode', $product->barcode) }}" placeholder="Scan or type barcode" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('barcode') border-error @enderror">
                        @error('barcode') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <hr class="border-outline-variant/20">

            <div>
                <h3 class="text-sm font-semibold text-secondary uppercase tracking-wider mb-4">2. Categorization & Vendor</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="category_id" class="text-sm font-medium text-on-surface dark:text-gray-300">Category *</label>
                        <div class="relative">
                            <select id="category_id" name="category_id" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant"><span class="material-symbols-outlined text-[20px]">expand_more</span></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="supplier_id" class="text-sm font-medium text-on-surface dark:text-gray-300">Supplier *</label>
                        <div class="relative">
                            <select id="supplier_id" name="supplier_id" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer" required>
                                <option value="" disabled>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant"><span class="material-symbols-outlined text-[20px]">expand_more</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-outline-variant/20">

            <div>
                <h3 class="text-sm font-semibold text-tertiary uppercase tracking-wider mb-4">3. Financials & Stock Control</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="space-y-1.5">
                        <label for="purchase_price" class="text-sm font-medium text-on-surface dark:text-gray-300">Cost Price ($) *</label>
                        <input type="number" step="0.01" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" placeholder="0.00" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>

                    <div class="space-y-1.5">
                        <label for="selling_price" class="text-sm font-medium text-on-surface dark:text-gray-300">Sale Price ($) *</label>
                        <input type="number" step="0.01" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" placeholder="0.00" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>

                    <div class="space-y-1.5">
                        <label for="stock_quantity" class="text-sm font-medium text-on-surface dark:text-gray-300">Current Stock *</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>

                    <div class="space-y-1.5">
                        <label for="minimum_stock" class="text-sm font-medium text-on-surface dark:text-gray-300">Alert Min Stock *</label>
                        <input type="number" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                    </div>
                </div>
            </div>

            <hr class="border-outline-variant/20">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="expiration_date" class="text-sm font-medium text-on-surface dark:text-gray-300">Expiration Date</label>
                    <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $product->expiration_date ? \Carbon\Carbon::parse($product->expiration_date)->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>

                <div class="space-y-1.5">
                    <label for="batch_number" class="text-sm font-medium text-on-surface dark:text-gray-300">Batch Number (Lot #)</label>
                    <input type="text" id="batch_number" name="batch_number" value="{{ old('batch_number', $product->batch_number) }}" placeholder="e.g., B-LOT102" class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/30">
                <a href="{{ route('products.index') }}" class="px-4 py-2.5 rounded-xl text-sm font-medium text-on-surface-variant hover:bg-surface-container dark:hover:bg-neutral-800 transition-colors">Cancel</a>
                <button type="submit" class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Update Product</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection