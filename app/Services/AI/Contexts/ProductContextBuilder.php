<?php

namespace App\Services\AI\Contexts;

use App\Models\Product;
use App\Services\AI\Contracts\AIContextBuilder;

class ProductContextBuilder implements AIContextBuilder
{
    public function build(): array
    {
        return [
            /*
             * |--------------------------------------------------------------------------
             * | Basic Inventory Information
             * |--------------------------------------------------------------------------
             */
            'total_products' => Product::count(),

            /*
             * |--------------------------------------------------------------------------
             * | Stock Risks
             * |--------------------------------------------------------------------------
             */
            'low_stock_products' =>
                Product::whereColumn(
                    'stock_quantity',
                    '<=',
                    'minimum_stock'
                )
                    ->get([
                        'name',
                        'stock_quantity',
                        'minimum_stock'
                    ]),
            'out_of_stock_products' =>
                Product::where(
                    'stock_quantity',
                    0
                )
                    ->get([
                        'name'
                    ]),

            /*
             * |--------------------------------------------------------------------------
             * | Expiry Intelligence
             * |--------------------------------------------------------------------------
             */
            'expiring_products' =>
                Product::whereNotNull(
                    'expiration_date'
                )
                    ->where(
                        'expiration_date',
                        '<=',
                        now()->addDays(30)
                    )
                    ->get([
                        'name',
                        'expiration_date',
                        'stock_quantity'
                    ]),

            /*
             * |--------------------------------------------------------------------------
             * | Inventory Distribution
             * |--------------------------------------------------------------------------
             */
            'highest_stock_products' =>
                Product::orderByDesc(
                    'stock_quantity'
                )
                    ->take(5)
                    ->get([
                        'name',
                        'stock_quantity'
                    ]),
            'lowest_stock_products' =>
                Product::orderBy(
                    'stock_quantity'
                )
                    ->take(5)
                    ->get([
                        'name',
                        'stock_quantity'
                    ]),

            /*
             * |--------------------------------------------------------------------------
             * | Inventory Value
             * |--------------------------------------------------------------------------
             */
            'inventory_value' =>
                Product::selectRaw(
                    'SUM(stock_quantity * purchase_price) as value'
                )
                    ->value('value') ?? 0,
        ];
    }
}
