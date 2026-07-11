<?php

namespace App\Services\AI\Contexts;

use App\Models\Product;
use App\Models\Sale;
use App\Services\AI\Contracts\AIContextBuilder;

class SalesContextBuilder implements AIContextBuilder
{
    public function build(): array
    {
        return [
            /*
             * |--------------------------------------------------------------------------
             * | Sales KPIs
             * |--------------------------------------------------------------------------
             */
            'sales_today' => Sale::whereDate('created_at', today())
                ->where('status', 'completed')
                ->sum('total'),
            'sales_last_30_days' => Sale::where('status', 'completed')
                ->where('created_at', '>=', now()->subDays(30))
                ->sum('total'),
            'orders_today' => Sale::whereDate('created_at', today())
                ->where('status', 'completed')
                ->count(),
            'orders_last_30_days' => Sale::where('status', 'completed')
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),

            /*
             * |--------------------------------------------------------------------------
             * | Revenue
             * |--------------------------------------------------------------------------
             */
            'average_order_value' => Sale::where('status', 'completed')
                ->avg('total'),
            'highest_sale' => Sale::where('status', 'completed')
                ->max('total'),
            'lowest_sale' => Sale::where('status', 'completed')
                ->min('total'),

            /*
             * |--------------------------------------------------------------------------
             * | Best Selling Products
             * |--------------------------------------------------------------------------
             */
            'top_products' => Product::withSum(
                'saleItems as sold_quantity',
                'quantity'
            )
                ->orderByDesc('sold_quantity')
                ->take(5)
                ->get([
                    'id',
                    'name'
                ]),

            /*
             * |--------------------------------------------------------------------------
             * | Recent Sales
             * |--------------------------------------------------------------------------
             */
            'recent_sales' => Sale::where('status', 'completed')
                ->latest()
                ->take(5)
                ->get([
                    'id',
                    'total',
                    'created_at'
                ]),

            /*
             * |--------------------------------------------------------------------------
             * | Daily Trend
             * |--------------------------------------------------------------------------
             */
            'daily_sales' => Sale::selectRaw('DATE(created_at) as date, SUM(total) as total')
                ->where('status', 'completed')
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
        ];
    }
}
