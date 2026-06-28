<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function addStock(
        Product $product,
        int $quantity,
        int $userId,
        ?string $reason = null,
        ?string $notes = null
    ) {
        DB::transaction(function () use ($product, $userId, $quantity, $reason, $notes) {
            $product->increment(
                'stock_quantity',
                $quantity,
                ['updated_at' => now()]
            );

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $userId,
                'type' => 'in',
                'quantity' => $quantity,
                'reason' => $reason ?? 'Stock IN',
                'notes' => $notes,
            ]);
        });
    }

    public function removeStock(
        Product $product,
        int $quantity,
        int $userId,
        ?string $reason = null,
        ?string $notes = null
    ): void {
        // It ensures that a set of related database operations either all succeed together or all fail together, preventing partial and inconsistent data updates.
        DB::transaction(function () use ($product, $userId, $quantity, $reason, $notes) {
            if ($product->stock_quantity < $quantity) {
                throw new \Exception(
                    'Insufficient stock'
                );
            }

            $product->decrement(
                'stock_quantity',
                $quantity,
                ['updated_at' => now()]
            );

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $userId,
                'type' => 'out',
                'quantity' => $quantity,
                'reason' => $reason,
                'notes' => $notes,
            ]);
        });
    }
}
