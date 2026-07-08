@extends('layouts.pharma')

@section('content')
<div class="space-y-6 print:space-y-4 print:p-0">
    
    <nav class="flex items-center gap-2 text-sm text-on-surface-variant font-medium print:hidden">
        <a href="{{ route('reports.index') }}" class="hover:text-primary transition-colors">Reports</a>
        <span class="material-symbols-outlined text-base select-none">chevron_right</span>
        <span class="text-on-surface">Profit Report</span>
    </nav>

    <div class="flex items-center justify-between border-b border-outline-variant pb-4 print:hidden">
        <div>
            <h1 class="font-headline-md text-headline-md text-on-surface">Profit & Revenue Report</h1>
            <p class="text-sm text-on-surface-variant">Financial audit sheet, profit margins, and sales costs.</p>
        </div>
        <button onclick="window.print()" class="flex items-center gap-2 bg-primary text-on-primary px-4 py-2 rounded-full hover:bg-primary-container hover:text-on-primary-container shadow-md transition font-medium">
            <span class="material-symbols-outlined text-sm">print</span>
            <span>Export PDF / Print</span>
        </button>
    </div>

    <div class="hidden print:flex items-center justify-between border-b-2 border-black pb-4 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-black uppercase tracking-wider">Pharmacy Financial Performance Report</h1>
            <p class="text-xs text-neutral-600">Fiscal Period Log | Generated: {{ now()->format('Y-m-d') }}</p>
        </div>
        <div class="text-right text-xs text-neutral-600">
            <p class="font-bold text-black">Financial Department</p>
            <p>PharmaSystem Co.</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 print:grid-cols-4 print:gap-2">
        <div class="p-5 rounded-2xl bg-surface-container-lowest border border-outline-variant print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-on-surface-variant font-medium uppercase tracking-wider print:text-neutral-700">Total Revenue</p>
            <h2 class="text-2xl font-bold text-on-surface mt-1 print:text-black">${{ number_format($revenue, 2) }}</h2>
        </div>

        <div class="p-5 rounded-2xl bg-surface-container-lowest border border-outline-variant print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-on-surface-variant font-medium uppercase tracking-wider print:text-neutral-700">Total Cost</p>
            <h2 class="text-2xl font-bold text-on-surface mt-1 print:text-black">${{ number_format($cost, 2) }}</h2>
        </div>

        <div class="p-5 rounded-2xl bg-surface-container-lowest border border-outline-variant print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-emerald-600 font-medium uppercase tracking-wider print:text-emerald-800">Net Profit</p>
            <h2 class="text-2xl font-bold text-emerald-600 mt-1 print:text-emerald-700">${{ number_format($profit, 2) }}</h2>
        </div>

        <div class="p-5 rounded-2xl bg-surface-container-lowest border border-outline-variant print:border-neutral-400 print:shadow-none">
            <p class="text-sm text-primary font-medium uppercase tracking-wider print:text-neutral-700">Net Margin</p>
            <h2 class="text-2xl font-bold text-on-surface mt-1 print:text-black">{{ $margin }}%</h2>
        </div>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl overflow-hidden print:border-neutral-400 print:rounded-none">
        <div class="p-5 border-b border-outline-variant bg-surface-container-low/40 print:bg-neutral-100 print:border-neutral-400">
            <h2 class="text-lg font-bold text-on-surface print:text-black">Profit Analysis Breakdown</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant font-medium print:bg-neutral-200 print:text-black border-b border-outline-variant print:border-neutral-400">
                        <th class="p-4 print:p-2">Transaction Date</th>
                        <th class="p-4 print:p-2">Gross Sales</th>
                        <th class="p-4 print:p-2">Operation Costs</th>
                        <th class="p-4 print:p-2 text-right">Net Profit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/60 print:divide-neutral-400">
                    @foreach ($profits as $item)
                        <tr class="hover:bg-surface-container-low/30 transition-colors odd:bg-surface-container-lowest even:bg-surface-container-low/10 print:bg-white">
                            <td class="p-4 print:p-2 font-mono text-on-surface print:text-black">{{ $item->date }}</td>
                            <td class="p-4 print:p-2 text-on-surface print:text-black">${{ number_format($item->sales, 2) }}</td>
                            <td class="p-4 print:p-2 text-on-surface-variant print:text-neutral-700">${{ number_format($item->cost, 2) }}</td>
                            <td class="p-4 print:p-2 text-right font-semibold text-emerald-600 print:text-emerald-700">${{ number_format($item->profit, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="hidden print:flex justify-between items-center mt-16 pt-8 border-t border-dashed border-neutral-400 text-xs text-neutral-600">
        <p>Financial Accountant: ___________________________</p>
        <p>Chief Executive Approval (CEO): ___________________________</p>
    </div>
</div>
@endsection