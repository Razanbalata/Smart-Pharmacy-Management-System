<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Pain Relief',
                'description' => 'Medications used to relieve pain and inflammation.',
                'status' => 'active',
            ],

            [
                'name' => 'Antibiotics',
                'description' => 'Drugs used to treat bacterial infections.',
                'status' => 'active',
            ],

            [
                'name' => 'Vitamins & Supplements',
                'description' => 'Nutritional supplements to support health.',
                'status' => 'active',
            ],

            [
                'name' => 'Diabetes Care',
                'description' => 'Medications and tools for diabetes management.',
                'status' => 'active',
            ],

            [
                'name' => 'Heart & Blood Pressure',
                'description' => 'Cardiovascular medications.',
                'status' => 'active',
            ],

            [
                'name' => 'Digestive System',
                'description' => 'Medicines for stomach and digestion problems.',
                'status' => 'active',
            ],

            [
                'name' => 'Skin Care',
                'description' => 'Creams and treatments for skin conditions.',
                'status' => 'active',
            ],

            [
                'name' => 'Baby Care',
                'description' => 'Products specially designed for babies.',
                'status' => 'active',
            ],

            [
                'name' => 'Medical Supplies',
                'description' => 'Basic medical tools and supplies.',
                'status' => 'active',
            ],

            [
                'name' => 'Personal Care',
                'description' => 'Daily hygiene and personal health products.',
                'status' => 'active',
            ],

            [
                'name' => 'Respiratory Care',
                'description' => 'Medicines for respiratory conditions.',
                'status' => 'active',
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