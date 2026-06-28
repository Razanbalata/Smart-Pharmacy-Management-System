<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'name' => 'System Admin',
        //     'email' => 'admin@pharma.com',
        //     'password' => Hash::make('password123'),
        //     'role' => 'admin',
        //     'status' => 'active',
        // ]);

        User::create([
            'name' => 'System pharmasist',
            'email' => 'pharmas@pharma.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'System casheir',
            'email' => 'cashier@pharma.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. زرع بعض الأقسام الطبية الحقيقية
        $antibiotics = Category::create(['name' => 'Antibiotics', 'description' => 'Bacterial infection treatments']);
        $painkillers = Category::create(['name' => 'Painkillers', 'description' => 'Analgesics and pain relief']);
        $vitamins = Category::create(['name' => 'Vitamins', 'description' => 'Supplements and multi-vitamins']);

        // 3. زرع بعض الموردين (شركات الأدوية)
        $supplierA = Supplier::create([
            'name' => 'Pfizer Pharma Dist.',
            'email' => 'contact@pfizer.com',
            'phone' => '+123456789',
        ]);
        $supplierB = Supplier::create([
            'name' => 'Hikma Pharmaceuticals',
            'email' => 'info@hikma.com',
            'phone' => '+962612345',
        ]);

        // 4. زرع أدوية حقيقية داخل جدول الـ Products
        Product::create([
            'name' => 'Amoxicillin 500mg',
            'scientific_name' => 'Amoxicillin Trihydrate',
            'sku' => 'AMX-500-PK',
            'barcode' => '6251234567891',
            'description' => 'Broad-spectrum antibiotic capsule.',
            'purchase_price' => 4.50,
            'selling_price' => 7.20,
            'stock_quantity' => 50,
            'minimum_stock' => 15,
            'expiration_date' => '2027-12-01',
            'batch_number' => 'B-AMX992',
            'status' => 'active',
            'category_id' => $antibiotics->id,
            'supplier_id' => $supplierB->id,
        ]);

        Product::create([
            'name' => 'Panadol Advance',
            'scientific_name' => 'Paracetamol',
            'sku' => 'PND-ADV-50',
            'barcode' => '5011234567123',
            'description' => 'Fast pain relief and fever reducer.',
            'purchase_price' => 1.20,
            'selling_price' => 2.50,
            'stock_quantity' => 120,
            'minimum_stock' => 20,
            'expiration_date' => '2028-06-15',
            'batch_number' => 'B-PND441',
            'status' => 'active',
            'category_id' => $painkillers->id,
            'supplier_id' => $supplierA->id,
        ]);

        Product::create([
            'name' => 'Vitamin C 1000mg',
            'scientific_name' => 'Ascorbic Acid',
            'sku' => 'VIT-C-EFF',
            'barcode' => '4001234561111',
            'description' => 'Effervescent tablets for immune support.',
            'purchase_price' => 3.00,
            'selling_price' => 5.00,
            'stock_quantity' => 8, // أقل من الحد الأدنى لتجربة تنبيه المخزون
            'minimum_stock' => 10,
            'expiration_date' => '2026-11-30',
            'batch_number' => 'B-VIT003',
            'status' => 'active',
            'category_id' => $vitamins->id,
            'supplier_id' => $supplierB->id,
        ]);
    }
}
