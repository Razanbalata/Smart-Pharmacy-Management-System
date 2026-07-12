@extends('layouts.pharma')

@section('content')
    <div class="space-y-6 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-[28px] text-primary">local_shipping</span>
                    <span>Purchase Orders</span>
                </h1>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                    Manage and track supply invoices, supplier deliveries, and incoming stock orders.
                </p>
            </div>
            <div>
                <button onclick="openAI('purchases')"
                    class="relative group overflow-hidden inline-flex items-center gap-2.5 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm shadow-[0_4px_20px_-4px_rgba(79,70,229,0.4)] hover:shadow-[0_4px_25px_rgba(79,70,229,0.6)] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">

                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></span>

                    <span
                        class="material-symbols-outlined text-[18px] tracking-normal group-hover:rotate-12 transition-transform duration-300">smart_toy</span>

                    <span>AI Analysis</span>
                </button>
                <button onclick="window.dispatchEvent(new CustomEvent('open-pdf-preview', { detail: { type: 'purchases' } }))"
                    class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200 text-sm">
                    <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                    <span>Export PDF</span>
                </button>
                <a href="{{ route('purchase.create') }}"
                    class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200 text-sm">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                    <span>New Purchase Order</span>
                </a>
            </div>
        </div>

        <div
            class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
                            <th class="px-6 py-4">Invoice #</th>
                            <th class="px-6 py-4">Supplier</th>
                            <th class="px-6 py-4">Processed By</th>
                            <th class="px-6 py-4">Total Cost</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                        @forelse($orders as $order)
                            <tr
                                class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                                <td class="px-6 py-4 font-mono font-bold text-primary dark:text-primary-light">
                                    #{{ $order->id }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-on-surface dark:text-white">
                                    {{ $order->supplier->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-on-surface-variant dark:text-gray-400">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px] text-gray-400">person</span>
                                        <span>{{ $order->user->name ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 font-mono font-bold text-base">
                                    ${{ number_format($order->total_cost, 2) }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($order->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200/30">
                                            <span
                                                class="material-symbols-outlined text-[14px] animate-spin-slow">hourglass_empty</span>
                                            <span>Pending</span>
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-success/10 text-success border border-success/20">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                            <span>Received</span>
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('purchase.edit', $order->id) }}"
                                            class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors flex items-center"
                                            title="Edit Order">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>

                                        @if ($order->status == 'pending')
                                            <form method="POST" action="{{ route('purchase.receive', $order->id) }}"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 text-xs font-bold bg-green-700 text-white hover:bg-green/90 px-3 py-1.5 rounded-lg shadow-sm transition-all"
                                                    title="Mark as Received and inject into stock">
                                                    <span
                                                        class="material-symbols-outlined text-[14px]">download_for_offline</span>
                                                    <span>Receive</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                    <span
                                        class="material-symbols-outlined text-4xl block mb-2 text-gray-300">receipt_long</span>
                                    No purchase orders found in the system logs.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            @if (method_exists($orders, 'links') && $orders->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <x-pdf-preview-modal />
@endpush
