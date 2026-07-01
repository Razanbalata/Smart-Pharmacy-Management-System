<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;

class SalesService
{
    public function createSale($userId)
    {
        return Sale::create([
            'user_id' => $userId,
            'subtotal' => 0,
            'discount' => 0,
            'total' => 0,
            'status' => 'draft',
        ]);
    }

    public function addItem(Sale $sale, Product $product, int $quantity)
    {
        // 1. Check stock
        if ($product->stock_quantity < $quantity) {
            throw new \Exception('Not enough stock');
        }

        $unitPrice = $product->selling_price;

        $subtotal = $unitPrice * $quantity;

        // 2. Add item
        $sale->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal,
        ]);

        // 3. Recalculate totals
        $this->recalculateTotals($sale);
    }

    public function recalculateTotals(Sale $sale)
    {
        $subtotal = $sale->items()->sum('subtotal');

        $sale->update([
            'subtotal' => $subtotal,
            'total' => $subtotal - $sale->discount,
        ]);
    }

    public function completeSale(Sale $sale, StockService $stockService)
    {
        DB::transaction(function () use ($sale, $stockService) {

            foreach ($sale->items as $item) {

                $stockService->removeStock(
                    $item->product,
                    $item->quantity,
                    auth()->id(),
                    'sale',
                    'Sale completed'
                );
            }

            $sale->update([
                'status' => 'completed'
            ]);
        });
    }

    public function removeItem(SaleItem $item)
    {
        $sale = $item->sale;

        $item->delete();

        $this->recalculateTotals($sale->fresh());
    }

    public function cancelSale(Sale $sale)
    {
        $sale->update([
            'status' => 'cancelled'
        ]);
    }
}
