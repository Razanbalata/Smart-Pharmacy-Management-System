@extends('layouts.pharma')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="font-headline-md text-headline-md text-on-surface">
                Inventory Overview
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant">
                Real-time stock analytics, expiration tracking, and warehouse distribution logs.
            </p>
        </div>
        <div class="flex items-center gap-2 text-xs font-mono-sm text-on-surface-variant bg-surface-container border border-outline-variant px-3 py-1.5 rounded-full w-fit">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Live Sync Active</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('products.index') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Inventory</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">{{ number_format($totalItems ?? 1248) }} Items</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Active commercial items and raw drug materials.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">package_2</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                @if(($growthRate ?? 4.2) >= 0)
                    <span class="text-emerald-600 bg-emerald-500/10 px-2 py-0.5 rounded-md font-semibold flex items-center gap-0.5">
                        <span class="material-symbols-outlined text-sm">trending_up</span> +{{ number_format($growthRate ?? 4.2, 1) }}% this month
                    </span>
                @else
                    <span class="text-rose-600 bg-rose-500/10 px-2 py-0.5 rounded-md font-semibold flex items-center gap-0.5">
                        <span class="material-symbols-outlined text-sm">trending_down</span> {{ number_format($growthRate ?? -1.5, 1) }}% this month
                    </span>
                @endif
                <span class="text-primary group-hover:underline flex items-center gap-1 font-medium">
                    Manage Stock <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('products.low-stock') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-amber-500 dark:hover:border-amber-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-amber-600 dark:text-amber-400 uppercase tracking-wider">Attention Required</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">{{ $lowStockCount ?? 24 }} Products</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Items below minimum threshold safety levels.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">⚠️ 5 Purchase orders pending</span>
                <span class="text-amber-600 dark:text-amber-400 group-hover:underline flex items-center gap-1 font-medium">
                    Restock Now <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('products.low-stock') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-error dark:hover:border-error-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-error uppercase tracking-wider">Critical Deficit</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">{{ $outOfStockCount ?? 7 }} Unavailable</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Completely out of stock. Sales currently halted.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-error/10 text-error flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">gpp_bad</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-error font-semibold bg-error/10 px-2 py-0.5 rounded-md">Urgent Action Required</span>
                <span class="text-error group-hover:underline flex items-center gap-1 font-medium">
                    Reorder Logs <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('inventory.expiring') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-orange-500 dark:hover:border-orange-400 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-orange-600 dark:text-orange-400 uppercase tracking-wider">Expiration Alert</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">{{ $expiringCount ?? 12 }} Batches</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Products expiring within the next 60 days.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-600 dark:text-orange-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">hourglass_top</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">⏳ Move to discount shelves</span>
                <span class="text-orange-600 dark:text-orange-400 group-hover:underline flex items-center gap-1 font-medium">
                    Check Batches <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('inventory.expired') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-rose-700 dark:hover:border-rose-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-rose-600 dark:text-rose-400 uppercase tracking-wider">Disposal Queue</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">{{ $expiredCount ?? 3 }} Items</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Expired stock requiring safe write-off and isolation.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">running_with_errors</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-rose-600 font-semibold bg-rose-500/10 px-2 py-0.5 rounded-md">Loss Tracked</span>
                <span class="text-rose-600 dark:text-rose-400 group-hover:underline flex items-center gap-1 font-medium">
                    Disposal Log <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="#" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-secondary dark:hover:border-secondary-fixed hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-secondary uppercase tracking-wider">Audit Trail</p>
                    <h3 class="font-headline-sm text-2xl font-bold text-on-surface">Updates Log</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Recent check-ins, sales deductions, and transfers.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">swap_page</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant text-xs">System logs integrated</span>
                <span class="text-secondary dark:text-secondary-fixed group-hover:underline flex items-center gap-1 font-medium">
                    View History <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-surface-container-lowest dark:bg-surface-container-low rounded-2xl border border-outline-variant p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-500">warning</span>
                        <h2 class="text-lg font-bold text-on-surface">Low Stock Products</h2>
                    </div>
                    <a href="{{ route('inventory.low-stock') }}" class="text-primary hover:text-primary-container text-sm font-medium hover:underline flex items-center gap-0.5">
                        View All <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($lowStockProducts as $product)
                        <div class="flex justify-between items-center p-3 rounded-xl bg-surface-container border border-outline-variant/40 hover:bg-surface-container-high transition-colors">
                            <div class="space-y-0.5">
                                <p class="font-semibold text-sm text-on-surface">{{ $product->name }}</p>
                                <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">inventory_2</span> Stock Qty: {{ $product->stock_quantity }}
                                </p>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                Low Stock
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-center space-y-2">
                            <span class="material-symbols-outlined text-4xl text-emerald-500 bg-emerald-500/10 p-3 rounded-full">check_circle</span>
                            <p class="text-sm font-medium text-on-surface">All products are well stocked!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest dark:bg-surface-container-low rounded-2xl border border-outline-variant p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-orange-500">hourglass_top</span>
                        <h2 class="text-lg font-bold text-on-surface">Expiring Soon</h2>
                    </div>
                    <a href="{{ route('inventory.expiring') }}" class="text-primary hover:text-primary-container text-sm font-medium hover:underline flex items-center gap-0.5">
                        View All <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($expiringProducts as $product)
                        <div class="flex justify-between items-center p-3 rounded-xl bg-surface-container border border-outline-variant/40 hover:bg-surface-container-high transition-colors">
                            <div class="space-y-0.5">
                                <p class="font-semibold text-sm text-on-surface">{{ $product->name }}</p>
                                <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">calendar_today</span> Exp: {{ $product->expiration_date }}
                                </p>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold bg-orange-500/10 text-orange-600 dark:text-orange-400 border border-orange-500/20">
                                Near Expiry
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-center space-y-2">
                            <span class="material-symbols-outlined text-4xl text-emerald-500 bg-emerald-500/10 p-3 rounded-full">verified</span>
                            <p class="text-sm font-medium text-on-surface">No near-expiry batches detected.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection