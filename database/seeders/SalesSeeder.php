<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StockMovement;
use App\Models\User;
use App\Services\StockService;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $cashiers = User::where('role', 'cashier')->get();
        $products = Product::all();
        $pharmacy = Pharmacy::first();
        $stockService = new StockService();

        if ($cashiers->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 15; $i++) {
            $cashier = $cashiers->random();

            $sale = Sale::create([
                'user_id' => $cashier->id,
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0,
                'status' => 'completed',
                'pharmacy_id' => $pharmacy->id,
                'created_at' => now()->subDays(rand(0, 30)),
            ]);

            $subtotal = 0;

            $items = $products->random(rand(2, 5));

            foreach ($items as $product) {
                if ($product->stock_quantity <= 0) {
                    continue;
                }

                $quantity = rand(1, 3);

                if ($quantity > $product->stock_quantity) {
                    $quantity = $product->stock_quantity;
                }

                $unitPrice = $product->selling_price;

                $itemSubtotal = $quantity * $unitPrice;

                $subtotal += $itemSubtotal;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $itemSubtotal,
                ]);

                $stockService->removeStock(
                    $product,
                    $quantity,
                    $cashier->id,
                    'sale',
                    'Product sold',
                    'Sale Invoice #' . $sale->id
                );
            }

            $discount = rand(0, 10);

            $sale->update([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $subtotal - $discount,
            ]);
        }
    }
}
