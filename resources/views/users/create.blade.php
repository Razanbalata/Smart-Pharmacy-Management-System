@extends('layouts.pharma')

@section('content')
<div class="max-w-2xl mx-auto p-6 space-y-6">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Add New Staff Member</h1>
        <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Create a new user account and allocate system privileges.</p>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 p-6 shadow-sm">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label for="name" class="text-sm font-medium text-on-surface dark:text-gray-300">Full Name</label>
                <div class="relative">
                    <input type="text" 
                           id="name"
                           name="name" 
                           value="New Cashier"
                           placeholder="John Doe" 
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('name') border-error focus:ring-error focus:border-error @enderror"
                           required>
                </div>
                @error('name')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="email" class="text-sm font-medium text-on-surface dark:text-gray-300">Email Address</label>
                <input type="email" 
                       id="email"
                       name="email" 
                       value="cashier3@pharmacy.com"
                       placeholder="name@pharmasmart.com" 
                       class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('email') border-error focus:ring-error focus:border-error @enderror"
                       required>
                @error('email')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-sm font-medium text-on-surface dark:text-gray-300">Temporary Password</label>
                <input type="password" 
                       id="password"
                       name="password" 
                       value='password'
                       placeholder="••••••••" 
                       class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('password') border-error focus:ring-error focus:border-error @enderror"
                       required>
                @error('password')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="role" class="text-sm font-medium text-on-surface dark:text-gray-300">System Role</label>
                <div class="relative">
                    <select id="role" 
                            name="role" 
                            class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer @error('role') border-error @enderror"
                            required>
                        <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                        <option value="pharmacist" {{ old('role') == 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                    </div>
                </div>
                @error('role')
                    <p class="text-xs font-medium text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/30">
                <a href="{{ route('users.index') }}" 
                   class="px-4 py-2.5 rounded-xl text-sm font-medium text-on-surface-variant hover:bg-surface-container dark:hover:bg-neutral-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Save User</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection