<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $user = User::query()->where('role', 'admin')->first();

        for ($i = 1; $i <= 10; $i++) {

            $supplier = $suppliers->random();

            $purchase = PurchaseOrder::create([
                'supplier_id' => $supplier->id,
                'user_id' => $user->id,
                'subtotal' => 0,
                'status' => 'received',
            ]);

            $subtotal = 0;

            // كل Purchase فيها 3-5 منتجات
            $items = $products->random(rand(3, 5));

            foreach ($items as $product) {

                $quantity = rand(10, 50);
                $unitPrice = $product->purchase_price;

                $itemSubtotal = $quantity * $unitPrice;
                $subtotal += $itemSubtotal;

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $itemSubtotal,
                ]);

                // 🔥 مهم جدًا: تحديث المخزون
                $product->increment('stock_quantity', $quantity);
            }

            $purchase->update([
                'subtotal' => $subtotal,
            ]);
        }
    }
}
