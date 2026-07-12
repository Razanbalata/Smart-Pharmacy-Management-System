<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index()
    {
        $summary = [
            // 🟢 KPIs
            'total_products' => $this->dashboardService->totalProducts(),
            'total_sales_today' => $this->dashboardService->totalSalesToday(),
            'total_purchases' => $this->dashboardService->totalPurchases(),
            'profit' => $this->dashboardService->profit(),
            'low_stock_count' => $this->dashboardService->lowStockCount(),
            'expired_count' => $this->dashboardService->expiredCount(),
            // 🟡 Inventory
            'low_stock_products' => $this->dashboardService->lowStockProducts(),
            'out_of_stock_products' => $this->dashboardService->outOfStockProducts(),
            'expiring_soon_products' => $this->dashboardService->expiringSoonProducts(),
            // 🟡 Sales
            'top_selling_products' => $this->dashboardService->topSellingProducts(),
            'average_order_value' => $this->dashboardService->averageOrderValue(),
            'weekly_sales' => $this->dashboardService->weeklySales(),
            'salesTrend' => $this->dashboardService->salesTrend(7)
        ];

        return view('dashboard', compact('summary'));
    }

    public function salesTrend(Request $request)
    {
        $period =
            $request->integer(
                'period',
                7
            );

        return response()->json([
            'success' => true,
            'data' =>
                $this
                    ->dashboardService
                    ->salesTrend($period)
        ]);
    }
}
