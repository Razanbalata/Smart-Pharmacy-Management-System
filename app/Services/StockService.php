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
        string $type,
        ?string $reason = null,
        ?string $notes = null
    ) {
        DB::transaction(function () use ($product, $userId, $type, $quantity, $reason, $notes) {
            $product->update([
                'stock_quantity' => $product->stock_quantity + $quantity
            ]);

            StockMovement::create([
                'product_id' => $product->id,
                'pharmacy_id' => $product->pharmacy_id,
                'user_id' => $userId,
                'type' => $type,
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
        string $type,
        ?string $reason = null,
        ?string $notes = null
    ): void {
        // It ensures that a set of related database operations either all succeed together or all fail together, preventing partial and inconsistent data updates.
        DB::transaction(function () use ($product, $userId, $type, $quantity, $reason, $notes) {
            if ($product->stock_quantity < $quantity) {
                throw new \Exception(
                    'Insufficient stock'
                );
            }

            $product->update([
                'stock_quantity' => $product->stock_quantity - $quantity
            ]);

            StockMovement::create([
                'product_id' => $product->id,
                'pharmacy_id' => $product->pharmacy_id,
                'user_id' => $userId,
                'type' => $type,
                'quantity' => $quantity,
                'reason' => $reason,
                'notes' => $notes,
            ]);
        });
    }

    public function adjustStock(Product $product, int $newQuantity, $userId, $reason = null)
    {
        DB::transaction(function () use ($product, $newQuantity, $userId, $reason) {
            $oldQuantity = $product->stock_quantity;

            if ($newQuantity < 0) {
                throw new \Exception('Stock cannot be negative');
            }

            $difference = $newQuantity - $oldQuantity;

            // تحديث المخزون
            $product->update([
                'stock_quantity' => $newQuantity
            ]);

            // تسجيل الحركة
            StockMovement::create([
                'product_id' => $product->id,
                'pharmacy_id' => $product->pharmacy_id,
                'user_id' => $userId,
                'type' => 'adjustment',
                'quantity' => $difference,
                'reason' => $reason ?? 'Stock Adjustment',
                'notes' => "Old: $oldQuantity | New: $newQuantity"
            ]);
        });
    }
}
