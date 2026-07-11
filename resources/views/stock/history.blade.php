@extends('layouts.pharma')

@section('content')
<div class="space-y-6 p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[28px] text-primary">history</span>
                <span>Stock Movement History</span>
            </h1>
            <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                Review and audit all incoming and outgoing inventory log activities.
            </p>
            
        </div>
        <button onclick="openAI('inventory')"
                class="relative group overflow-hidden inline-flex items-center gap-2.5 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm shadow-[0_4px_20px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_4px_25px_rgba(79,70,229,0.6)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">

                <span
                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>

                <span
                    class="material-symbols-outlined text-[18px] tracking-normal group-hover:rotate-12 transition-transform duration-300">smart_toy</span>

                <span>AI Analysis</span>
            </button>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-2xl border border-outline-variant/40 shadow-sm">
        <form method="GET" action="{{ url()->current() }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            
            <div class="relative sm:col-span-6">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-on-surface-variant/70">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </span>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by product name..." 
                    class="w-full pl-10 pr-4 py-2 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/50 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                >
            </div>

            <div class="relative sm:col-span-4">
                <select name="type" class="w-full pl-4 pr-10 py-2 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                    <option value="">All Movement Types</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>IN (Stock Received)</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>OUT (Stock Dispatched)</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </div>
            </div>

            <div class="flex gap-2 sm:col-span-2 w-full">
                <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 dark:bg-neutral-800 dark:hover:bg-neutral-700 text-white font-medium text-sm py-2 px-4 rounded-xl transition duration-150 shadow-sm flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    <span>Filter</span>
                </button>
                
                @if(request('search') || request('type') || request('product'))
                    <a href="{{ url()->current() }}" class="p-2 bg-error/10 text-error hover:bg-error/20 rounded-xl transition-colors flex items-center justify-center" title="Clear Filters">
                        <span class="material-symbols-outlined text-[20px]">filter_alt_off</span>
                    </a>
                @endif
            </div>

            @if(request('product'))
                <input type="hidden" name="product" value="{{ request('product') }}">
            @endif

        </form>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
                        <th class="px-6 py-4">Product Details</th>
                        <th class="px-6 py-4">Processed By</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Quantity</th>
                        <th class="px-6 py-4">Reason / Source</th>
                        <th class="px-6 py-4">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                    @forelse ($movements as $move)
                        <tr class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-on-surface dark:text-white">{{ $move->product->name }}</div>
                                @if($move->product->sku)
                                    <div class="text-[11px] font-mono text-gray-400 mt-0.5">SKU: {{ $move->product->sku }}</div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 font-medium text-on-surface-variant dark:text-gray-300">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[16px] text-gray-400">person</span>
                                    <span>{{ $move->user->name ?? 'System' }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if ($move->type == 'in')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-success/10 text-success border border-success/20">
                                        <span class="material-symbols-outlined text-[14px]">arrow_downward</span>
                                        <span>IN</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-error/10 text-error border border-error/20">
                                        <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                                        <span>OUT</span>
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-mono font-bold text-base">
                                {{ number_format($move->quantity) }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $reasonClass = match($move->reason) {
                                        'purchase' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/40 dark:text-blue-400',
                                        'sale' => 'bg-green-100 text-green-800 dark:bg-green-950/40 dark:text-green-400',
                                        'damaged' => 'bg-red-100 text-red-800 dark:bg-red-950/40 dark:text-red-400',
                                        'initial stock' => 'bg-purple-100 text-purple-800 dark:bg-purple-950/40 dark:text-purple-400',
                                        default => 'bg-gray-100 text-gray-800 dark:bg-neutral-800 dark:text-gray-400'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium capitalize {{ $reasonClass }}">
                                    {{ str_replace('_', ' ', $move->reason) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-xs text-on-surface-variant dark:text-gray-400 font-mono">
                                {{ $move->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">history_toggle_off</span>
                                No stock movements match your search filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($movements, 'links') && $movements->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                {{ $movements->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection