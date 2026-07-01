<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $cashiers = User::where('role', 'cashier')->get();
        $products = Product::all();

        for ($i = 1; $i <= 15; $i++) {

            $cashier = $cashiers->random();

            $sale = Sale::create([
                'user_id' => $cashier->id,
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0,
                'status' => 'completed',
            ]);

            $subtotal = 0;

            // كل فاتورة فيها 2 - 5 منتجات
            $items = $products->random(rand(2, 5));

            foreach ($items as $product) {

                // نتأكد أن في stock
                if ($product->stock_quantity <= 0) {
                    continue;
                }

                $quantity = rand(1, 3);

                // لو الكمية أكبر من المتوفر نعدلها
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

                // 🔥 أهم خطوة: خصم من المخزون
                $product->decrement('stock_quantity', $quantity);
            }

            // discount بسيط (محاكاة حقيقية)
            $discount = rand(0, 5);

            $sale->update([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $subtotal - $discount,
            ]);
        }
    }
}