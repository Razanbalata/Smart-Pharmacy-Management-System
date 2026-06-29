@extends('layouts.pharma')

@section('content')
    <div class="max-w-2xl mx-auto p-6 space-y-6">

        <div class="flex items-center gap-3">
            <div class="p-3 bg-primary/10 text-primary rounded-xl">
                <span class="material-symbols-outlined text-[28px]">note_add</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Create Purchase Order</h1>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-0.5">Initialize a new procurement invoice to
                    restock pharmacy goods.</p>
            </div>
        </div>

        <div
            class="bg-surface-container-low dark:bg-neutral-900/30 p-6 rounded-2xl border border-outline-variant/40 shadow-sm">
            <form method="POST" action="{{ route('purchase.store') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label
                        class="text-xs font-bold tracking-wider text-on-surface-variant dark:text-gray-300 uppercase block">
                        Choose Supplier
                    </label>

                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-on-surface-variant/70">
                            <span class="material-symbols-outlined text-[20px]">store</span>
                        </span>

                        <select name="supplier_id" required
                            class="w-full pl-11 pr-10 py-3 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Select a registered supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>

                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-on-surface-variant/70 dark:text-gray-400">
                        Selecting a supplier will link this transaction to their profile for future financial auditing.
                    </p>
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-outline-variant/20">
                    <a href="{{ route('purchase.index') }}"
                        class="inline-flex items-center justify-center text-sm font-semibold text-on-surface-variant hover:text-on-surface px-4 py-2.5 rounded-xl transition-colors">
                        Cancel
                    </a>

                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary text-white hover:bg-primary/90 px-6 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 text-sm cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                        <span>Create & Continue</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
