<?php

namespace App\Services\AI\Contexts;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Services\AI\Contracts\AIContextBuilder;
use App\Services\ReportService;
use Illuminate\Support\Facades\DB;

class ReportsContextBuilder implements AIContextBuilder
{
    public function __construct(
        private ReportService $reportService
    ) {}

    public function build(): array
    {
        /*
         * |--------------------------------------------------------------------------
         * | Financial Overview
         * |--------------------------------------------------------------------------
         */

        $revenue =
            $this
                ->reportService
                ->totalRevenue();

        $cost =
            $this
                ->reportService
                ->totalCost();

        $profit =
            $this
                ->reportService
                ->totalProfit();

        $margin =
            $this
                ->reportService
                ->profitMargin();

        /*
         * |--------------------------------------------------------------------------
         * | Sales Overview
         * |--------------------------------------------------------------------------
         */

        $totalSales = Sale::where(
            'status',
            'completed'
        )
            ->count();

        /*
         * |--------------------------------------------------------------------------
         * | Best Selling Products
         * |--------------------------------------------------------------------------
         */

        $bestSellingProducts = SaleItem::query()
            ->select(
                'product_id',
                DB::raw(
                    'SUM(quantity) as sold_quantity'
                )
            )
            ->with('product:id,name')
            ->groupBy(
                'product_id'
            )
            ->orderByDesc(
                'sold_quantity'
            )
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'product' =>
                        $item->product?->name,
                    'quantity' =>
                        (int) $item->sold_quantity
                ];
            });

        /*
         * |--------------------------------------------------------------------------
         * | Recent Sales Activity
         * |--------------------------------------------------------------------------
         */

        $recentSales = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->latest()
            ->limit(5)
            ->get([
                'id',
                'total',
                'created_at'
            ]);

        return [
            'financial_summary' => [
                'revenue' =>
                    round($revenue, 2),
                'cost' =>
                    round($cost, 2),
                'profit' =>
                    round($profit, 2),
                'profit_margin' =>
                    $margin
            ],
            'sales_statistics' => [
                'completed_sales' =>
                    $totalSales
            ],
            'best_selling_products' =>
                $bestSellingProducts,
            'recent_sales' =>
                $recentSales
        ];
    }
}
