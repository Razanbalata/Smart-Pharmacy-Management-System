@extends('layouts.pharma')

@section('content')
<div class="max-w-2xl mx-auto p-6 space-y-6">
    <!-- العنوان والوصف -->
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Edit Supplier</h1>
        <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Modify the details and contact directory for this supplier.</p>
    </div>

    <!-- بطاقة النموذج (Form Container) -->
    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 p-6 shadow-sm">
        <form method="POST" action="{{ route('suppliers.update', $supplier->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- اسم المورد -->
            <div class="space-y-1.5">
                <label for="name" class="text-sm font-medium text-on-surface dark:text-gray-300">Supplier Name</label>
                <input type="text" 
                       id="name"
                       name="name" 
                       value="{{ old('name', $supplier->name) }}"
                       placeholder="e.g. MedTech Distribution" 
                       class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('name') border-error focus:ring-error focus:border-error @enderror"
                       required>
                @error('name')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- شبكة المدخلات (رقم الهاتف والبريد الإلكتروني) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- رقم الهاتف -->
                <div class="space-y-1.5">
                    <label for="phone" class="text-sm font-medium text-on-surface dark:text-gray-300">Phone Number</label>
                    <input type="text" 
                           id="phone"
                           name="phone" 
                           value="{{ old('phone', $supplier->phone) }}"
                           placeholder="e.g. +970 599 000 000" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('phone') border-error focus:ring-error focus:border-error @enderror"
                           required>
                    @error('phone')
                        <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-medium text-on-surface dark:text-gray-300">Email Address</label>
                    <input type="email" 
                           id="email"
                           name="email" 
                           value="{{ old('email', $supplier->email) }}"
                           placeholder="supplier@company.com" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('email') border-error focus:ring-error focus:border-error @enderror">
                    @error('email')
                        <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- حالة المورد -->
            <div class="space-y-1.5">
                <label for="status" class="text-sm font-medium text-on-surface dark:text-gray-300">Supplier Status</label>
                <div class="relative">
                    <select id="status" 
                            name="status" 
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer @error('status') border-error @enderror"
                            required>
                        <option value="active" @selected(old('status', $supplier->status) == 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $supplier->status) == 'inactive')>Inactive</option>
                    </select>
                    <!-- سهم القائمة المنسدلة المخصص -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                    </div>
                </div>
                @error('status')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- أزرار التحكم -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/30">
                <a href="{{ route('suppliers.index') }}" 
                   class="px-4 py-2.5 rounded-xl text-sm font-medium text-on-surface-variant hover:bg-surface-container dark:hover:bg-neutral-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Update Supplier</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection