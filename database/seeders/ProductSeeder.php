<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $pharmacy = Pharmacy::first();

        $products = [
            [
                'name' => 'Panadol Extra 24 Tablets',
                'sku' => 'MED-001',
                'barcode' => '628100000001',
                'purchase_price' => 5,
                'selling_price' => 8,
                'stock_quantity' => 150,
                'minimum_stock' => 30,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Augmentin 625mg',
                'sku' => 'MED-002',
                'barcode' => '628100000002',
                'purchase_price' => 12,
                'selling_price' => 18,
                'stock_quantity' => 80,
                'minimum_stock' => 15,
                'category_id' => 2,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Vitamin C 1000mg',
                'sku' => 'MED-003',
                'barcode' => '628100000003',
                'purchase_price' => 7,
                'selling_price' => 12,
                'stock_quantity' => 200,
                'minimum_stock' => 40,
                'category_id' => 3,
                'supplier_id' => 4,
            ],
            [
                'name' => 'Brufen 400mg',
                'sku' => 'MED-004',
                'barcode' => '628100000004',
                'purchase_price' => 4,
                'selling_price' => 7,
                'stock_quantity' => 40,
                'minimum_stock' => 10,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Glucophage 500mg',
                'sku' => 'MED-005',
                'barcode' => '628100000005',
                'purchase_price' => 6,
                'selling_price' => 10,
                'stock_quantity' => 25,
                'minimum_stock' => 30,
                'category_id' => 5,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Insulin Pen',
                'sku' => 'MED-006',
                'barcode' => '628100000006',
                'purchase_price' => 40,
                'selling_price' => 55,
                'stock_quantity' => 8,
                'minimum_stock' => 10,
                'category_id' => 5,
                'supplier_id' => 4,
            ],
            [
                'name' => 'CeraVe Moisturizer',
                'sku' => 'MED-007',
                'barcode' => '628100000007',
                'purchase_price' => 20,
                'selling_price' => 30,
                'stock_quantity' => 35,
                'minimum_stock' => 10,
                'category_id' => 6,
                'supplier_id' => 4,
            ],
            [
                'name' => 'Digital Thermometer',
                'sku' => 'MED-008',
                'barcode' => '628100000008',
                'purchase_price' => 10,
                'selling_price' => 18,
                'stock_quantity' => 15,
                'minimum_stock' => 20,
                'category_id' => 8,
                'supplier_id' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                ...$product,
                'pharmacy_id' => $pharmacy->id,
            ]);
        }
    }
}
