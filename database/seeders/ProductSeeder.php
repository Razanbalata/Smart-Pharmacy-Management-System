<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryMap = Category::all()->keyBy('name');
        $supplierMap = Supplier::all();

        $products = [

            // Pain Relief
            [
                'name' => 'Panadol Extra',
                'scientific_name' => 'Paracetamol + Caffeine',
                'category' => 'Pain Relief',
                'supplier' => 'Hikma Pharmaceuticals',
                'purchase_price' => 2.00,
                'selling_price' => 3.00,
                'stock_quantity' => 200,
                'minimum_stock' => 40,
            ],

            [
                'name' => 'Advil 400mg',
                'scientific_name' => 'Ibuprofen',
                'category' => 'Pain Relief',
                'supplier' => 'Pfizer',
                'purchase_price' => 3.50,
                'selling_price' => 5.00,
                'stock_quantity' => 150,
                'minimum_stock' => 30,
            ],

            // Antibiotics
            [
                'name' => 'Augmentin 625mg',
                'scientific_name' => 'Amoxicillin + Clavulanic Acid',
                'category' => 'Antibiotics',
                'supplier' => 'Julphar',
                'purchase_price' => 6.00,
                'selling_price' => 8.50,
                'stock_quantity' => 100,
                'minimum_stock' => 20,
            ],

            [
                'name' => 'Azithromycin 500mg',
                'scientific_name' => 'Azithromycin',
                'category' => 'Antibiotics',
                'supplier' => 'Pfizer',
                'purchase_price' => 4.00,
                'selling_price' => 6.50,
                'stock_quantity' => 120,
                'minimum_stock' => 25,
            ],

            // Vitamins
            [
                'name' => 'Vitamin C 1000mg',
                'scientific_name' => 'Ascorbic Acid',
                'category' => 'Vitamins & Supplements',
                'supplier' => 'Bayer',
                'purchase_price' => 2.50,
                'selling_price' => 4.00,
                'stock_quantity' => 180,
                'minimum_stock' => 30,
            ],

            [
                'name' => 'Vitamin D3',
                'scientific_name' => 'Cholecalciferol',
                'category' => 'Vitamins & Supplements',
                'supplier' => 'Sanofi',
                'purchase_price' => 3.00,
                'selling_price' => 5.00,
                'stock_quantity' => 140,
                'minimum_stock' => 25,
            ],

        ];

        foreach ($products as $product) {

            Product::updateOrCreate(
                [
                    'name' => $product['name']
                ],
                [
                    'scientific_name' => $product['scientific_name'],
                    'sku' => strtoupper(Str::random(8)),
                    'barcode' => Str::random(12),
                    'description' => $product['name'] . ' medical product',

                    'purchase_price' => $product['purchase_price'],
                    'selling_price' => $product['selling_price'],

                    'stock_quantity' => $product['stock_quantity'],
                    'minimum_stock' => $product['minimum_stock'],

                    'expiration_date' => now()->addYear(),
                    'batch_number' => 'BATCH-' . rand(1000, 9999),

                    'status' => 'active',

                    'category_id' => $categoryMap[$product['category']]->id ?? null,
                    'supplier_id' => $supplierMap->where('name', $product['supplier'])->first()->id ?? null,
                ]
            );
        }
    }
}