<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $pharmacy = Pharmacy::first();
        $categories = [
            [
                'name' => 'Pain Relief',
                'description' => 'Medicines for pain and fever relief',
            ],
            [
                'name' => 'Antibiotics',
                'description' => 'Medicines used to treat bacterial infections',
            ],
            [
                'name' => 'Vitamins & Supplements',
                'description' => 'Health supplements and vitamins',
            ],
            [
                'name' => 'Cold & Flu',
                'description' => 'Cold, cough and flu medicines',
            ],
            [
                'name' => 'Diabetes Care',
                'description' => 'Diabetes treatment products',
            ],
            [
                'name' => 'Skin Care',
                'description' => 'Skin and dermatology products',
            ],
            [
                'name' => 'Baby Care',
                'description' => 'Baby health and hygiene products',
            ],
            [
                'name' => 'Medical Equipment',
                'description' => 'Medical devices and equipment',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                ...$category,
                'pharmacy_id' => $pharmacy->id,
                ]);
        }
    }
}
