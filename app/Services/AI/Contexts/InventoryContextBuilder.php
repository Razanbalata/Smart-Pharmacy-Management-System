<?php

namespace App\Services\AI\Contexts;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class InventoryContextBuilder
{
    public function build(): array
    {
        /*
         * |--------------------------------------------------------------------------
         * | Basic Inventory Statistics
         * |--------------------------------------------------------------------------
         */

        $totalProducts = Product::count();

        $inventoryValue = Product::sum(
            DB::raw('stock_quantity * purchase_price')
        );

        /*
         * |--------------------------------------------------------------------------
         * | Stock Risks
         * |--------------------------------------------------------------------------
         */

        $lowStockProducts = Product::query()
            ->whereColumn(
                'stock_quantity',
                '<=',
                'minimum_stock'
            )
            ->select([
                'name',
                'stock_quantity',
                'minimum_stock'
            ])
            ->get();

        $outOfStockProducts = Product::query()
            ->where(
                'stock_quantity',
                '<=',
                0
            )
            ->pluck('name');

        /*
         * |--------------------------------------------------------------------------
         * | Expiration Risks
         * |--------------------------------------------------------------------------
         */

        $expiringProducts = Product::query()
            ->whereNotNull(
                'expiration_date'
            )
            ->where(
                'expiration_date',
                '<=',
                now()->addDays(90)
            )
            ->select([
                'name',
                'expiration_date',
                'stock_quantity'
            ])
            ->get();

        /*
         * |--------------------------------------------------------------------------
         * | Movement Analysis
         * |--------------------------------------------------------------------------
         */

        $movementSummary = StockMovement::query()
            ->selectRaw(
                'type, COUNT(*) as movements, SUM(quantity) as quantity'
            )
            ->groupBy('type')
            ->get();

        /*
         * |--------------------------------------------------------------------------
         * | Most Moved Products
         * |--------------------------------------------------------------------------
         */

        $mostMovedProducts = StockMovement::query()
            ->selectRaw(
                'product_id, SUM(quantity) as total_quantity'
            )
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc(
                'total_quantity'
            )
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'product' =>
                        $item->product?->name,
                    'movement_quantity' =>
                        (int) $item->total_quantity
                ];
            });

        return [
            'total_products' =>
                $totalProducts,
            'inventory_value' =>
                round(
                    $inventoryValue ?? 0,
                    2
                ),
            'low_stock_products' =>
                $lowStockProducts,
            'out_of_stock_products' =>
                $outOfStockProducts,
            'expiring_products' =>
                $expiringProducts,
            'movement_summary' =>
                $movementSummary,
            'most_moved_products' =>
                $mostMovedProducts,
        ];
    }
}
