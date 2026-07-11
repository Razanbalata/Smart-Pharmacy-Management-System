<?php

namespace App\Services\AI\Contexts;

use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;

class PurchasesContextBuilder
{
    public function build(): array
    {
        $totalOrders = PurchaseOrder::count();

        $receivedOrders = PurchaseOrder::where(
            'status',
            'received'
        )->count();

        $pendingOrders = PurchaseOrder::where(
            'status',
            'pending'
        )->count();

        $totalPurchaseAmount = PurchaseOrder::sum(
            'total_cost'
        );

        $averagePurchaseValue = PurchaseOrder::avg(
            'total_cost'
        );

        /*
         * |--------------------------------------------------------------------------
         * | Top Suppliers
         * |--------------------------------------------------------------------------
         */

        $topSuppliers = PurchaseOrder::query()
            ->selectRaw('supplier_id, COUNT(*) as orders, SUM(total_cost) as total')
            ->with('supplier:id,name')
            ->groupBy('supplier_id')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($supplier) {
                return [
                    'supplier' => $supplier->supplier?->name,
                    'orders' => (int) $supplier->orders,
                    'amount' => (float) $supplier->total,
                ];
            })
            ->values();

        /*
         * |--------------------------------------------------------------------------
         * | Most Purchased Products
         * |--------------------------------------------------------------------------
         */

        $topProducts = PurchaseItem::query()
            ->selectRaw('product_id, SUM(quantity) as quantity')
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('quantity')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'product' => $item->product?->name,
                    'quantity' => (int) $item->quantity,
                ];
            })
            ->values();

        /*
         * |--------------------------------------------------------------------------
         * | Recent Purchases
         * |--------------------------------------------------------------------------
         */

        $recentPurchases = PurchaseOrder::query()
            ->latest()
            ->with('supplier:id,name')
            ->take(5)
            ->get()
            ->map(function ($purchase) {
                return [
                    'supplier' => $purchase->supplier?->name,
                    'amount' => (float) $purchase->total_cost,
                    'status' => $purchase->status,
                    'date' => $purchase->created_at->toDateString(),
                ];
            })
            ->values();

        return [
            'total_purchase_orders' => $totalOrders,
            'received_orders' => $receivedOrders,
            'pending_orders' => $pendingOrders,
            'total_purchase_amount' => (float) $totalPurchaseAmount,
            'average_purchase_value' => round(
                $averagePurchaseValue,
                2
            ),
            'top_suppliers' => $topSuppliers,
            'most_purchased_products' => $topProducts,
            'recent_purchases' => $recentPurchases,
        ];
    }
}
