@extends('layouts.pharma')

@section('content')
    <div class="space-y-6 p-6">

        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-outline-variant/30 pb-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-[28px] text-primary">receipt_long</span>
                    <span>Purchase Order #{{ $order->id }}</span>
                </h1>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Manage items, unit costs, and finalize
                    warehouse receiving logs.</p>
            </div>

            @if ($order->status == 'pending')
                <form method="POST" action="{{ route('purchase.receive', $order->id) }}"
                    onsubmit="return confirm('Are you sure you want to finalize this order? This will immediately inject all item quantities into your active stock.')">
                    @csrf
                    <button type="submit"
                        class="w-full bg-primary sm:w-auto inline-flex items-center justify-center gap-2 text-white hover:bg-success/90 px-6 py-3 rounded-xl font-bold shadow-md transition-all duration-200 cursor-pointer text-sm tracking-wide">
                        <span class="material-symbols-outlined text-[20px]">task_alt</span>
                        <span>RECEIVE PURCHASE ORDER</span>
                    </button>
                </form>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-secondary/10 text-secondary rounded-lg"><span
                        class="material-symbols-outlined">store</span></div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400 font-medium">Supplier Name</p>
                    <p class="text-base font-bold text-on-surface dark:text-white mt-0.5">{{ $order->supplier->name }}</p>
                </div>
            </div>
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-primary/10 text-primary rounded-lg"><span
                        class="material-symbols-outlined">monetization_on</span></div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400 font-medium">Total Gross Cost</p>
                    <p class="text-base font-black text-primary dark:text-primary-light font-mono mt-0.5">
                        ${{ number_format($order->total_cost, 2) }}</p>
                </div>
            </div>
            <div
                class="bg-surface-container-low dark:bg-neutral-900/30 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
                <div class="p-3 bg-gray-100 dark:bg-neutral-800 text-gray-500 rounded-lg"><span
                        class="material-symbols-outlined">hourglass_empty</span></div>
                <div>
                    <p class="text-xs text-on-surface-variant dark:text-gray-400 font-medium">Invoice Status</p>
                    @if ($order->status == 'pending')
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 mt-1 rounded-md text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400 capitalize">{{ $order->status }}</span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 px-2 py-0.5 mt-1 rounded-md text-xs font-bold bg-success/10 text-success capitalize">{{ $order->status }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            @if ($order->status == 'pending')
                <div
                    class="lg:col-span-4 bg-surface-container-low dark:bg-neutral-900/30 p-5 rounded-2xl border border-outline-variant/40 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 border-b border-outline-variant/20 pb-2 mb-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">add_shopping_cart</span>
                        <h3 class="font-bold text-sm text-on-surface dark:text-white uppercase tracking-wider">Add Item to
                            Order</h3>
                    </div>

                    <form method="POST" action="{{ route('purchase.addItem', $order->id) }}" class="space-y-4">
                        @csrf

                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-on-surface-variant dark:text-gray-300">Product</label>
                            <div class="relative">
                                <select name="product_id" required
                                    class="w-full pl-3 pr-10 py-2 text-sm rounded-xl border border-outline-variant/60 bg-surface-container-low dark:bg-neutral-900 text-on-surface dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none cursor-pointer">
                                    <option value="" disabled selected>-- Select Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[18px]">expand_more</span></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <label
                                    class="text-xs font-semibold text-on-surface-variant dark:text-gray-300">Quantity</label>
                                <input type="number" name="quantity" required min="1" placeholder="Qty"
                                    class="w-full px-3 py-2 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-on-surface-variant dark:text-gray-300">Unit Cost
                                    ($)</label>
                                <input type="number" name="cost" required min="0" step="0.01"
                                    placeholder="Cost"
                                    class="w-full px-3 py-2 text-sm rounded-xl border border-outline-variant/60 bg-transparent text-on-surface dark:text-white placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-white hover:bg-primary/90 font-semibold text-sm py-2.5 rounded-xl transition duration-150 shadow-sm flex items-center justify-center gap-1 cursor-pointer mt-2">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            <span>Insert Item</span>
                        </button>
                    </form>
                </div>
            @endif

            <div
                class="{{ $order->status == 'pending' ? 'lg:col-span-8' : 'lg:col-span-12' }} bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
                <div
                    class="p-4 bg-surface-container dark:bg-neutral-800/50 border-b border-outline-variant/40 flex items-center justify-between">
                    <span
                        class="text-sm font-bold uppercase tracking-wider text-on-surface-variant dark:text-gray-300">Manifest
                        Line Items</span>
                    <span
                        class="text-xs font-mono bg-primary/10 text-primary font-bold px-2 py-0.5 rounded-md">{{ $order->items->count() }}
                        Entries</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-surface-container/50 dark:bg-neutral-800/30 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-xs font-bold uppercase tracking-wider">
                                <th class="px-6 py-3.5">Medical Product</th>
                                <th class="px-6 py-3.5">Quantity</th>
                                <th class="px-6 py-3.5">Unit Cost</th>
                                <th class="px-6 py-3.5 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                            @forelse ($order->items as $item)
                                <tr
                                    class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                                    <td class="px-6 py-4 font-semibold text-on-surface dark:text-white">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="px-6 py-4 font-mono">
                                        {{ number_format($item->quantity) }} units
                                    </td>
                                    <td class="px-6 py-4 font-mono text-on-surface-variant dark:text-gray-400">
                                        ${{ number_format($item->cost, 2) }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-mono font-bold text-right text-base text-on-surface dark:text-white">
                                        ${{ number_format($item->quantity * $item->cost, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                        <span
                                            class="material-symbols-outlined text-4xl block mb-2 text-gray-300">playlist_add</span>
                                        No medicines or items linked to this purchase manifest yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
