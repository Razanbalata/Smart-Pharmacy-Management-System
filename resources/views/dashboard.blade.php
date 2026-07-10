@extends('layouts.pharma')

@section('content')

    <div class="p-gutter max-w-container-max mx-auto w-full space-y-8">

        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Pharmacy Dashboard</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">System status is operational.
                    {{ $summary['low_stock_count'] }} items require attention.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-surface-container-lowest border border-outline-variant px-4 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Export PDF
                </button>
                <button onclick="window.dispatchEvent(new CustomEvent('ai:open', { detail: { module: 'Dashboard' } }))"
                    class="relative group overflow-hidden inline-flex items-center gap-2.5 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm shadow-[0_4px_20px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_4px_25px_rgba(79,70,229,0.6)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">

                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>

                    <span
                        class="material-symbols-outlined text-[18px] tracking-normal group-hover:rotate-12 transition-transform duration-300">smart_toy</span>

                    <span>AI Analysis</span>
                </button>
            </div>
        </div>

        {{-- Dynamic Onboarding Checklist --}}
        {{-- يظهر الكارت فقط إذا كانت الصيدلية جديدة (لا يوجد مبيعات بعد ولم يضف موظفين) --}}
        @if (($summary['total_sales_today'] ?? 0) == 0 && $summary['total_products'] == 0)
            <div
                class="bg-gradient-to-r from-primary/5 to-secondary/5 border border-primary/20 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined font-bold">auto_awesome</span>
                        <h3 class="text-lg font-bold text-on-surface">Welcome to PharmaSmart! Let's get set up</h3>
                    </div>
                    <p class="text-sm text-on-surface-variant max-w-2xl">
                        Your pharmacy profile has been created successfully. Follow these quick steps to fully activate your
                        workspace and start managing sales.
                    </p>

                    {{-- Steps Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3">
                        <a href="{{ route('users.index') }}"
                            class="flex items-center gap-3 p-3 bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary/40 transition-all group">
                            <span
                                class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-bold group-hover:bg-primary group-hover:text-white transition-colors">1</span>
                            <span class="text-sm font-medium text-on-surface group-hover:text-primary transition-colors">Add
                                Pharmacists & Cashiers</span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 p-3 bg-surface-container-lowest border border-outline-variant rounded-xl hover:border-primary/40 transition-all group">
                            <span
                                class="w-6 h-6 rounded-full bg-secondary/10 text-secondary flex items-center justify-center text-xs font-bold group-hover:bg-secondary group-hover:text-white transition-colors">2</span>
                            <span
                                class="text-sm font-medium text-on-surface group-hover:text-secondary transition-colors">Add
                                First Product to Inventory</span>
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block opacity-20 pr-4">
                    <span class="material-symbols-outlined text-8xl text-primary">storefront</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-primary/10 text-primary rounded-lg">
                        <span class="material-symbols-outlined">inventory</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Products</p>
                <h3 class="font-display-lg text-display-lg font-bold">{{ $summary['total_products'] }}</h3>
            </div>

            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-secondary/10 text-secondary rounded-lg">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Sales Today</p>
                {{-- تعديل العملة إلى JD لتطابق بقية النظام --}}
                <h3 class="font-display-lg text-display-lg font-bold">
                    {{ number_format($summary['total_sales_today'] ?? 0, 2) }} <span
                        class="text-xs font-bold text-on-surface-variant">JD</span></h3>
            </div>

            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-green-500/10 text-green-600 rounded-lg">
                        <span class="material-symbols-outlined">trending_up</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Profit</p>
                <h3 class="font-display-lg text-display-lg font-bold text-green-600">
                    {{ number_format($summary['profit'] ?? 0, 2) }} <span class="text-xs font-bold text-green-600">JD</span>
                </h3>
            </div>

            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-amber-500/10 text-amber-600 rounded-lg">
                        <span class="material-symbols-outlined">warning</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Low Stock Items</p>
                <h3 class="font-display-lg text-display-lg font-bold text-amber-600">{{ $summary['low_stock_count'] }}</h3>
            </div>

            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-error/10 text-error rounded-lg">
                        <span class="material-symbols-outlined">event_busy</span>
                    </div>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Expired Products</p>
                <h3 class="font-display-lg text-display-lg font-bold text-error">{{ $summary['expired_count'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <h4 class="font-headline-sm text-headline-sm">Sales Trends Analytics</h4>
                    <span class="text-xs text-on-surface-variant font-mono-sm">Data connected to ChartJS/SVG</span>
                </div>
                <div class="flex-1 min-h-[300px] w-full relative flex items-end gap-2">
                    <div class="absolute inset-0 flex flex-col justify-between py-2">
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">6k JD</span></div>
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">4k JD</span></div>
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">2k JD</span></div>
                        <div class="w-full border-t border-outline-variant flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">0 JD</span></div>
                    </div>
                    <svg class="absolute bottom-0 left-0 w-full h-[260px] overflow-visible pointer-events-none"
                        viewbox="0 0 1000 300">
                        <defs>
                            <lineargradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(79, 70, 229, 0.2)"></stop>
                                <stop offset="100%" stop-color="rgba(79, 70, 229, 0)"></stop>
                            </lineargradient>
                        </defs>
                        <path
                            d="M0,250 Q50,220 100,230 T200,180 T300,210 T400,140 T500,160 T600,100 T700,120 T800,60 T900,80 T1000,40"
                            fill="none" stroke="#3525cd" stroke-width="3"></path>
                        <path
                            d="M0,250 Q50,220 100,230 T200,180 T300,210 T400,140 T500,160 T600,100 T700,120 T800,60 T900,80 T1000,40 V300 H0 Z"
                            fill="url(#chartGradient)"></path>
                    </svg>
                    <div class="absolute bottom-0 left-0 w-full flex justify-between px-2 pt-4">
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">MON</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">TUE</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">WED</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">THU</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">FRI</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">SAT</span>
                        <span class="font-mono-sm text-mono-sm text-on-surface-variant">SUN</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-surface-container-low p-6 rounded-xl border border-primary-container/30 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary"
                            style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <h4 class="font-headline-sm text-headline-sm">PharmaSmart Alerts</h4>
                    </div>

                    <div class="space-y-4">
                        @if (isset($summary['expiring_soon_products']) && count($summary['expiring_soon_products']) > 0)
                            @foreach ($summary['expiring_soon_products'] as $product)
                                <div
                                    class="bg-surface-container-lowest p-4 rounded-lg border border-error/20 shadow-sm relative">
                                    <p class="font-label-md text-label-md text-error mb-1">Expiration Alert</p>
                                    <p class="font-body-md text-body-md text-on-surface leading-tight">
                                        <strong>{{ $product->name }}</strong> expires soon on <span
                                            class="text-error font-semibold">{{ \Carbon\Carbon::parse($product->expiration_date)->format('Y-m-d') }}</span>.
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <div
                                class="bg-surface-container-lowest p-4 rounded-lg border border-outline-variant shadow-sm text-center py-6">
                                <span class="material-symbols-outlined text-green-500 text-3xl mb-1">check_circle</span>
                                <p class="text-sm text-on-surface-variant">No products expiring soon.</p>
                            </div>
                        @endif

                        @if (isset($summary['top_selling_products']) && count($summary['top_selling_products']) > 0)
                            <div class="bg-surface-container-lowest p-4 rounded-lg border border-primary/20 shadow-sm">
                                <p class="font-label-md text-label-md text-primary mb-1">Top Performer</p>
                                <p class="font-body-md text-body-md text-on-surface leading-tight">
                                    <strong>{{ $summary['top_selling_products'][0]->name ?? 'N/A' }}</strong> is your
                                    highest-selling product this period. Ensure stable supply chains.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <button onclick="openAI('dashboard')"
                    class="mt-6 w-full py-2 border border-primary text-primary rounded-lg font-label-md text-label-md hover:bg-primary/5 transition-colors">
                    <span class="inline-flex items-center gap-1">System Intelligence Audit</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-6 border-b border-outline-variant flex justify-between items-center">
                        <h4 class="font-headline-sm text-headline-sm">Low Stock Inventory</h4>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Action
                            Required</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-surface-container-low border-b border-outline-variant">
                                <tr>
                                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase">
                                        Product Name</th>
                                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase">SKU
                                    </th>
                                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase">
                                        Category</th>
                                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase">
                                        Current Stock</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($summary['low_stock_products'] as $product)
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="px-6 py-4 font-body-md text-body-md font-medium text-on-surface">
                                            {{ $product->name }}</td>
                                        <td class="px-6 py-4 font-mono-sm text-mono-sm text-on-surface-variant">
                                            {{ $product->sku }}</td>
                                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface-variant">
                                            {{ $product->category->name ?? '-' }}</td>
                                        <td class="px-6 py-4 font-body-md text-body-md">
                                            <span class="text-error font-semibold">{{ $product->stock_quantity }}
                                                Units</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-8 text-on-surface-variant italic">No low
                                            stock items detected. Awesome!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 bg-surface-container-low border-t border-outline-variant text-right">
                    <a class="text-primary font-label-md text-label-md hover:underline inline-flex items-center gap-1"
                        href="#">
                        Manage Full Inventory <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>

            <div
                class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-6 border-b border-outline-variant">
                        <h4 class="font-headline-sm text-headline-sm">Top Selling Products</h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-surface-container-low border-b border-outline-variant">
                                <tr>
                                    <th class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase">
                                        Product</th>
                                    <th
                                        class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase text-right">
                                        Units Sold</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse($summary['top_selling_products'] as $product)
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="px-6 py-4 font-body-md text-body-md font-medium text-on-surface">
                                            {{ $product->name }}</td>
                                        <td
                                            class="px-6 py-4 font-body-md text-body-md text-right font-semibold text-primary">
                                            {{ $product->sold_quantity ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-8 text-on-surface-variant italic">No
                                            sales recordings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 bg-surface-container-low border-t border-outline-variant text-center">
                    <span class="text-xs text-on-surface-variant">Live updates based on latest transactions</span>
                </div>
            </div>
        </div>
    </div>

    @if (isset($summary['weekly_sales']))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const weeklySalesData = @json($summary['weekly_sales']);
                console.log("ERP Dynamic Chart Data loaded:", weeklySalesData);
            });
        </script>
    @endif
@endsection
