@extends('layouts.pharma')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="font-headline-md text-headline-md text-on-surface">
                Reports Overview
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant">
                Analyze sales, purchases, inventory, and pharmacy performance.
            </p>
        </div>
        <div class="flex items-center gap-2 text-xs font-mono-sm text-on-surface-variant bg-surface-container border border-outline-variant px-3 py-1.5 rounded-full w-fit">
            <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
            <span>Data Updated Just Now</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('sales.index') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Financials</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Sales Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">View sales transactions, daily invoices, and revenue streams.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">point_of_sale</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">Monthly: <span class="text-emerald-600 font-bold">${{ number_format($monthlySales ?? 14250, 2) }}</span></span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('purchase.index') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Procurement</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Purchase Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Analyze supplier invoices, stock acquisitions, and costs.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">Orders: <span class="text-blue-600 dark:text-blue-400 font-bold">{{ $pendingPurchasesCount ?? 8 }} Pending</span></span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('reports.profit') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Analytics</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Profit Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Net profit margins, revenue analysis, and cost deduction tracking.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">insights</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-emerald-600 bg-emerald-500/10 px-2 py-0.5 rounded-md font-semibold flex items-center gap-0.5">
                    <span class="material-symbols-outlined text-sm">trending_up</span> Margin +24.5%
                </span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        <a href="{{ route('reports.inventory') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Logistics</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Inventory Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Stock valuation, turnover rates, and warehouse distribution metrics.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">inventory</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">Valuation: <span class="font-bold">${{ number_format($stockValuation ?? 84320, 0) }}</span></span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

        {{-- <a href="#" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">CRM</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Customer Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Analyze patient/customer behavior, loyal programs, and top buyers.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">Active Accounts: <span class="font-bold">{{ $activeCustomers ?? '412 Patients' }}</span></span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a> --}}

        <a href="{{ route('suppliers.index') }}" class="group block p-6 rounded-2xl bg-surface-container-lowest dark:bg-surface-container-low border border-outline-variant dark:border-outline hover:border-primary dark:hover:border-primary-container hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div class="space-y-2">
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Supply Chain</p>
                    <h3 class="font-headline-sm text-xl font-bold text-on-surface group-hover:text-primary transition-colors">Supplier Report</h3>
                    <p class="text-body-md text-on-surface-variant text-sm">Evaluate distributor performance, lead times, and fulfillment scores.</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-2xl">local_shipping</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/60 flex items-center justify-between text-xs">
                <span class="text-on-surface-variant font-medium">Partners: <span class="font-bold">{{ $suppliersCount ?? 18 }} Companies</span></span>
                <span class="text-primary group-hover:underline flex items-center gap-0.5 font-medium">
                    View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>

    </div>
</div>
@endsection