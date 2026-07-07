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
                'description' => 'Medications used to relieve pain and inflammation.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Antibiotics',
                'description' => 'Drugs used to treat bacterial infections.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Vitamins & Supplements',
                'description' => 'Nutritional supplements to support health.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Diabetes Care',
                'description' => 'Medications and tools for diabetes management.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Heart & Blood Pressure',
                'description' => 'Cardiovascular medications.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Digestive System',
                'description' => 'Medicines for stomach and digestion problems.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Skin Care',
                'description' => 'Creams and treatments for skin conditions.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Baby Care',
                'description' => 'Products specially designed for babies.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Medical Supplies',
                'description' => 'Basic medical tools and supplies.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Personal Care',
                'description' => 'Daily hygiene and personal health products.',
                'status' => 'active',   
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Respiratory Care',
                'description' => 'Medicines for respiratory conditions.',
                'status' => 'active',
                'pharmacy_id' => $pharmacy->id,
            ],
        ];

        foreach ($categories as $category) {

            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}