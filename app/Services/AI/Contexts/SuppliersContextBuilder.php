<?php

namespace App\Services\AI\Contexts;

use App\Models\PurchaseOrder;
use App\Models\Supplier;

class SuppliersContextBuilder
{
    public function build(): array
    {
        /*
         * |--------------------------------------------------------------------------
         * | Basic Statistics
         * |--------------------------------------------------------------------------
         */

        $totalSuppliers = Supplier::count();

        $activeSuppliers = Supplier::where(
            'status',
            'active'
        )->count();

        $inactiveSuppliers = Supplier::where(
            'status',
            'inactive'
        )->count();

        /*
         * |--------------------------------------------------------------------------
         * | Supplier Performance
         * |--------------------------------------------------------------------------
         */

        $supplierPerformance = PurchaseOrder::query()
            ->selectRaw(
                'supplier_id,
                COUNT(*) as orders_count,
                SUM(total_cost) as total_purchase'
            )
            ->with('supplier:id,name,status')
            ->groupBy('supplier_id')
            ->orderByDesc('total_purchase')
            ->get()
            ->map(function ($item) {
                return [
                    'supplier' =>
                        $item->supplier?->name,
                    'status' =>
                        $item->supplier?->status,
                    'orders_count' =>
                        (int) $item->orders_count,
                    'total_purchase' =>
                        (float) $item->total_purchase,
                ];
            })
            ->values();

        /*
         * |--------------------------------------------------------------------------
         * | Suppliers Without Purchases
         * |--------------------------------------------------------------------------
         */

        $inactiveByUsage = Supplier::query()
            ->whereDoesntHave(
                'purchaseOrders'
            )
            ->pluck('name')
            ->values();

        /*
         * |--------------------------------------------------------------------------
         * | Average Purchase Per Supplier
         * |--------------------------------------------------------------------------
         */

        $averagePurchase = PurchaseOrder::avg(
            'total_cost'
        );

        return [
            'total_suppliers' =>
                $totalSuppliers,
            'active_suppliers' =>
                $activeSuppliers,
            'inactive_suppliers' =>
                $inactiveSuppliers,
            'average_purchase_order_value' =>
                round(
                    $averagePurchase ?? 0,
                    2
                ),
            'supplier_performance' =>
                $supplierPerformance,
            'suppliers_without_orders' =>
                $inactiveByUsage,
        ];
    }
}
