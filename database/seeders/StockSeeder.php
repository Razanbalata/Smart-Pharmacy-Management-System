<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Services\StockService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stockService = new StockService();
        $user = User::first();
        $product = Product::first(); // أو create / find

        $stockService->addStock(
            $product,
            50,
            'initial',
             $user->id,
            'Initial stock test',
            'Seeder insertion'
        );
    }
}
