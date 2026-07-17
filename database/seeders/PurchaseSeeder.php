<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
use App\Services\StockService;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $user = User::where('role', 'admin')->first();
        $pharmacy = Pharmacy::first();
        $stockService = new StockService();

        $purchases = [
            [
                'supplier' => 1,
                'products' => [1, 2, 3],
            ],
            [
                'supplier' => 2,
                'products' => [4, 5, 6],
            ],
            [
                'supplier' => 3,
                'products' => [7, 8],
            ],
            [
                'supplier' => 4,
                'products' => [1, 3, 7],
            ],
        ];

        foreach ($purchases as $data) {
            $supplier = $suppliers->find($data['supplier']);

            $purchase = PurchaseOrder::create([
                'supplier_id' => $supplier->id,
                'user_id' => $user->id,
                'total_cost' => 0,
                'status' => 'received',
                'pharmacy_id' => $pharmacy->id,
            ]);

            $total = 0;

            foreach ($data['products'] as $productId) {
                $product = $products->find($productId);

                $quantity = rand(20, 60);

                $cost = $product->purchase_price;

                $total += $quantity * $cost;

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'cost' => $cost,
                ]);

                $stockService->addStock(
                    $product,
                    $quantity,
                    $user->id,
                    'purchase',
                    'Stock received from purchase order',
                    'Purchase Order #' . $purchase->id
                );
            }

            $purchase->update([
                'total_cost' => $total
            ]);
        }
    }
}
