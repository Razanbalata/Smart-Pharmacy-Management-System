<?php

namespace App\Services\AI\Contexts;

use App\Models\StockMovement;
use App\Services\AI\Contracts\AIContextBuilder;

class StockContextBuilder implements AIContextBuilder
{
    public function build(): array
    {
        $movements = StockMovement::with('product')
            ->latest()
            ->get();

        return [
            /*
             * |--------------------------------------------------------------------------
             * | General Statistics
             * |--------------------------------------------------------------------------
             */
            'total_movements' =>
                $movements->count(),

            /*
             * |--------------------------------------------------------------------------
             * | Movement Types Analysis
             * |--------------------------------------------------------------------------
             */
            'movement_summary' => [
                'initial' =>
                    $movements
                        ->where('type', 'initial')
                        ->count(),
                'purchase' =>
                    $movements
                        ->where('type', 'purchase')
                        ->count(),
                'sale' =>
                    $movements
                        ->where('type', 'sale')
                        ->count(),
                'adjustment' =>
                    $movements
                        ->where('type', 'adjustment')
                        ->count(),
                'damaged' =>
                    $movements
                        ->where('type', 'damaged')
                        ->count(),
                'expired' =>
                    $movements
                        ->where('type', 'expired')
                        ->count(),
                'return' =>
                    $movements
                        ->where('type', 'return')
                        ->count(),
            ],

            /*
             * |--------------------------------------------------------------------------
             * | Stock Risks
             * |--------------------------------------------------------------------------
             */
            'loss_movements' => [
                'damaged_quantity' =>
                    $movements
                        ->where('type', 'damaged')
                        ->sum('quantity'),
                'expired_quantity' =>
                    $movements
                        ->where('type', 'expired')
                        ->sum('quantity'),
            ],

            /*
             * |--------------------------------------------------------------------------
             * | Most Active Products
             * |--------------------------------------------------------------------------
             */
            'top_moved_products' =>
                $movements
                    ->groupBy('product_id')
                    ->map(function ($items) {
                        return [
                            'product' =>
                                $items
                                    ->first()
                                    ->product
                                    ->name,
                            'total_quantity' =>
                                $items
                                    ->sum('quantity'),
                            'movements' =>
                                $items->count(),
                        ];
                    })
                    ->sortByDesc('total_quantity')
                    ->take(5)
                    ->values(),

            /*
             * |--------------------------------------------------------------------------
             * | Recent Activity
             * |--------------------------------------------------------------------------
             */
            'recent_movements' =>
                $movements
                    ->take(10)
                    ->map(function ($movement) {
                        return [
                            'product' =>
                                $movement->product->name,
                            'type' =>
                                $movement->type,
                            'quantity' =>
                                $movement->quantity,
                            'date' =>
                                $movement
                                    ->created_at
                                    ->format('Y-m-d'),
                        ];
                    })
                    ->values(),
        ];
    }
}
