@extends('layouts.pharma')

@section('content')
    <!-- Dashboard Content -->
    <div class="p-gutter max-w-container-max mx-auto w-full space-y-8">
        <!-- Welcome Header -->
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Pharmacy Dashboard</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">System status is operational. 12
                    pending prescriptions.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-surface-container-lowest border border-outline-variant px-4 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    Last 24 Hours
                </button>
                <button
                    class="bg-surface-container-lowest border border-outline-variant px-4 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-surface-container-low transition-all">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Export PDF
                </button>
            </div>
        </div>
        <!-- Top Row: Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Products -->
            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-primary/10 text-primary rounded-lg">
                        <span class="material-symbols-outlined">inventory</span>
                    </div>
                    <span class="text-green-600 font-label-md text-label-md flex items-center gap-1">+2.4% <span
                            class="material-symbols-outlined text-[14px]">trending_up</span></span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Products</p>
                <h3 class="font-display-lg text-display-lg font-bold">1,284</h3>
            </div>
            <!-- Total Sales Today -->
            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-secondary/10 text-secondary rounded-lg">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-green-600 font-label-md text-label-md flex items-center gap-1">+12.1% <span
                            class="material-symbols-outlined text-[14px]">trending_up</span></span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Sales Today</p>
                <h3 class="font-display-lg text-display-lg font-bold">$4,921.50</h3>
            </div>
            <!-- Low Stock Count -->
            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-tertiary-container/10 text-tertiary-container rounded-lg">
                        <span class="material-symbols-outlined">warning</span>
                    </div>
                    <span class="text-error font-label-md text-label-md flex items-center gap-1">-5 <span
                            class="material-symbols-outlined text-[14px]">arrow_downward</span></span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Low Stock Items</p>
                <h3 class="font-display-lg text-display-lg font-bold text-tertiary-container">14</h3>
            </div>
            <!-- Expired Count -->
            <div
                class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-error/10 text-error rounded-lg">
                        <span class="material-symbols-outlined">event_busy</span>
                    </div>
                    <span class="text-on-surface-variant font-label-md text-label-md flex items-center gap-1">Action
                        req.</span>
                </div>
                <p class="font-label-md text-label-md text-on-surface-variant mb-1">Expired Products</p>
                <h3 class="font-display-lg text-display-lg font-bold text-error">3</h3>
            </div>
        </div>
        <!-- Middle Row: Charts & AI Insights -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sales Analytics Chart -->
            <div
                class="lg:col-span-2 bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <h4 class="font-headline-sm text-headline-sm">Sales Trends Analytics</h4>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1 rounded bg-primary-container text-on-primary font-label-md text-label-md">Sales</button>
                        <button
                            class="px-3 py-1 rounded hover:bg-surface-container-low font-label-md text-label-md transition-colors">Volume</button>
                    </div>
                </div>
                <div class="flex-1 min-h-[300px] w-full relative flex items-end gap-2">
                    <!-- Mock Chart Representation -->
                    <div class="absolute inset-0 flex flex-col justify-between py-2">
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">$6k</span></div>
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">$4k</span></div>
                        <div class="w-full border-t border-outline-variant/30 flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">$2k</span></div>
                        <div class="w-full border-t border-outline-variant flex justify-end"><span
                                class="text-[10px] text-outline-variant mt-1">$0k</span></div>
                    </div>
                    <!-- Chart SVG Polyline Simulation -->
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
                    <!-- X-Axis Labels -->
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
            <!-- AI Insights Panel -->
            <div class="bg-surface-container-low p-6 rounded-xl border border-primary-container/30 ai-glow flex flex-col">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary"
                        style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    <h4 class="font-headline-sm text-headline-sm">PharmaSmart AI</h4>
                </div>
                <div class="space-y-4 flex-1">
                    <!-- Insight 1 -->
                    <div
                        class="bg-surface-container-lowest p-4 rounded-lg border border-outline-variant shadow-sm relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-1 opacity-20 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-[16px] text-primary">spark</span>
                        </div>
                        <p class="font-label-md text-label-md text-primary mb-1">Reorder Suggestion</p>
                        <p class="font-body-md text-body-md text-on-surface leading-tight mb-3">
                            <strong>Amoxicillin 500mg</strong> demand increased by 40% this week. Reorder 50 units
                            now to avoid stockout.
                        </p>
                        <button
                            class="w-full py-2 bg-primary-container text-on-primary rounded-lg font-label-md text-label-md hover:brightness-110 transition-all">Quick
                            Order</button>
                    </div>
                    <!-- Insight 2 -->
                    <div
                        class="bg-surface-container-lowest p-4 rounded-lg border border-outline-variant shadow-sm relative">
                        <p class="font-label-md text-label-md text-secondary mb-1">Stock Prediction</p>
                        <p class="font-body-md text-body-md text-on-surface leading-tight">
                            High probability of <strong>Lisinopril</strong> expiration in Zone B. 12 units expiring
                            in 15 days.
                        </p>
                        <div
                            class="mt-3 flex items-center gap-2 text-secondary font-label-md text-label-md cursor-pointer hover:underline">
                            <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                            View batch details
                        </div>
                    </div>
                    <!-- Insight 3 -->
                    <div
                        class="bg-surface-container-lowest p-4 rounded-lg border border-outline-variant shadow-sm relative">
                        <p class="font-label-md text-label-md text-on-tertiary-fixed-variant mb-1">Revenue Alert
                        </p>
                        <p class="font-body-md text-body-md text-on-surface leading-tight">
                            Peak hours predicted between <strong>16:00 - 18:00</strong> tomorrow. Ensure 2 registers
                            are active.
                        </p>
                    </div>
                </div>
                <button
                    class="mt-6 w-full py-2 border border-primary text-primary rounded-lg font-label-md text-label-md hover:bg-primary/5 transition-colors">View
                    All Insights</button>
            </div>
        </div>
        <!-- Bottom Row: Low Stock Data Table -->
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-6 border-b border-outline-variant flex justify-between items-center">
                <h4 class="font-headline-sm text-headline-sm">Low Stock Inventory</h4>
                <a class="text-primary font-label-md text-label-md hover:underline" href="#">Manage All
                    Inventory</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low border-b border-outline-variant">
                        <tr>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Product Name</th>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                SKU</th>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Category</th>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Current Stock</th>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="px-6 py-4 font-body-md text-body-md font-medium">Atorvastatin 20mg Tab</td>
                            <td class="px-6 py-4 font-mono-sm text-mono-sm text-on-surface-variant">PH-ATR-201</td>
                            <td class="px-6 py-4 font-body-md text-body-md">Statins</td>
                            <td class="px-6 py-4 font-body-md text-body-md">12 Units</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-tertiary-fixed text-tertiary">Critical
                                    Low</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="px-6 py-4 font-body-md text-body-md font-medium">Metformin 500mg ER</td>
                            <td class="px-6 py-4 font-mono-sm text-mono-sm text-on-surface-variant">PH-MET-505</td>
                            <td class="px-6 py-4 font-body-md text-body-md">Antidiabetic</td>
                            <td class="px-6 py-4 font-body-md text-body-md">45 Units</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container/20 text-secondary">Below
                                    Buffer</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="px-6 py-4 font-body-md text-body-md font-medium">Albuterol HFA Inhaler</td>
                            <td class="px-6 py-4 font-mono-sm text-mono-sm text-on-surface-variant">PH-ALB-002</td>
                            <td class="px-6 py-4 font-body-md text-body-md">Respiratory</td>
                            <td class="px-6 py-4 font-body-md text-body-md">8 Units</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-tertiary-fixed text-tertiary">Critical
                                    Low</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="px-6 py-4 font-body-md text-body-md font-medium">Gabapentin 300mg Cap</td>
                            <td class="px-6 py-4 font-mono-sm text-mono-sm text-on-surface-variant">PH-GAB-303</td>
                            <td class="px-6 py-4 font-body-md text-body-md">Neurology</td>
                            <td class="px-6 py-4 font-body-md text-body-md">52 Units</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container/20 text-secondary">Below
                                    Buffer</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-surface-container-low border-t border-outline-variant flex justify-between items-center">
                <p class="font-body-md text-body-md text-on-surface-variant italic">Showing 4 of 14 alerted items
                </p>
                <div class="flex gap-2">
                    <button class="p-1 rounded hover:bg-surface-container transition-colors"><span
                            class="material-symbols-outlined">chevron_left</span></button>
                    <button class="p-1 rounded hover:bg-surface-container transition-colors"><span
                            class="material-symbols-outlined">chevron_right</span></button>
                </div>
            </div>
        </div>
    </div>
@endsection
