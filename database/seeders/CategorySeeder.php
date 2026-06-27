<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pain Relievers',
                'description' => 'Medications used to relieve pain and reduce fever.',
            ],
            [
                'name' => 'Antibiotics',
                'description' => 'Medicines used to treat bacterial infections.',
            ],
            [
                'name' => 'Vitamins & Supplements',
                'description' => 'Dietary supplements and vitamins.',
            ],
            [
                'name' => 'Cold & Flu',
                'description' => 'Cold, cough and flu medications.',
            ],
            [
                'name' => 'Medical Devices',
                'description' => 'Medical equipment and diagnostic devices.',
            ],
        ];
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'status' => 'active',
                ]
            );
        }
    }
}
