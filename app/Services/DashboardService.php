<?php

namespace App\Services;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /* ========================
        🟢 KPI METRICS (Numbers that summarize the business)
    ======================== */

    public function totalSalesToday()
    {
        return Sale::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total');
    }

    public function totalPurchases()
    {
        return PurchaseOrder::query()
            ->whereDate(
                'created_at',
                today()
            )
            ->sum('total_cost');
    }

    public function profit()
    {
        return $this->totalSalesToday() - $this->totalPurchases();
    }

    public function totalProducts()
    {
        return Product::count();
    }

    public function expiredCount()
    {
        return Product::whereNotNull('expiration_date')
            ->where('expiration_date', '<', now())
            ->count();
    }

    /* ========================
        🟡 INVENTORY INSIGHTS (What is happening in stock right now)
    ======================== */

    public function lowStockProducts()
    {
        return Product::whereColumn('stock_quantity', '<=', 'minimum_stock')
            ->get();
    }

    public function outOfStockProducts()
    {
        return Product::where('stock_quantity', 0)->get();
    }

    public function expiringSoonProducts()
    {
        return Product::whereNotNull('expiration_date')
            ->where('expiration_date', '<=', now()->addDays(30))
            ->get();
    }

    public function mostStockedProducts()
    {
        return Product::orderByDesc('stock_quantity')
            ->take(5)
            ->get();
    }

    /* ========================
        🟡 SALES ANALYTICS (What is selling and how much)
    ======================== */

    public function topSellingProducts()
    {
        return Product::withSum('saleItems as sold_quantity', 'quantity')
            ->orderByDesc('sold_quantity')
            ->take(5)
            ->get();
    }

    public function averageOrderValue()
    {
        return Sale::where('status', 'completed')
            ->avg('total');
    }

    public function weeklySales()
    {
        return Sale::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /* ========================
        🔴 ALERTS (Problems that need attention)
    ======================== */

    public function lowStockCount()
    {
        return Product::whereColumn('stock_quantity', '<=', 'minimum_stock')
            ->count();
    }

    public function expiredProductsCount()
    {
        return Product::whereNotNull('expiration_date')
            ->where('expiration_date', '<', now())
            ->count();
    }

    /* ========================
        🟢 STATUS (Overall health of the business
     ======================== */

    public function calculateStatus()
    {
        $lowStockCount = $this->lowStockCount();
        $expiredCount = $this->expiredProductsCount();

        if ($lowStockCount > 10 || $expiredCount > 0) {
            return 'critical';
        }

        if ($lowStockCount > 0) {
            return 'warning';
        }

        return 'good';
    }

    public function statusLabel()
    {
        $status = $this->calculateStatus();

        return match ($status) {
            'critical' => 'Critical',
            'warning' => 'Warning',
            default => 'Good',
        };
    }

    public function salesLast30Days()
    {
        return Sale::where('status', 'completed')
            ->where(
                'created_at',
                '>=',
                now()->subDays(30)
            )
            ->sum('total');
    }

    public function purchasesLast30Days()
    {
        return PurchaseOrder::where(
            'created_at',
            '>=',
            now()->subDays(30)
        )
            ->sum('total_cost');
    }

    public function salesCountLast30Days()
    {
        return Sale::where('status', 'completed')
            ->where(
                'created_at',
                '>=',
                now()->subDays(30)
            )
            ->count();
    }

    public function profitLast30Days()
    {
        return $this->salesLast30Days()
            - $this->purchasesLast30Days();
    }

    public function inventoryValue()
    {
        return Product::sum(
            DB::raw(
                'stock_quantity * purchase_price'
            )
        );
    }

    public function salesTrend(
        int $days = 7
    ) {
        $sales = Sale::where(
            'pharmacy_id',
            auth()->user()->pharmacy_id
        )
            ->where(
                'created_at',
                '>=',
                now()->subDays($days)
            )
            ->selectRaw(
                'DATE(created_at) as date,
            SUM(total) as total'
            )
            ->groupBy('date')
            ->pluck(
                'total',
                'date'
            );

        return collect(
            range($days - 1, 0)
        )
            ->map(function ($day) use ($sales) {
                $date =
                    now()
                        ->subDays($day)
                        ->format('Y-m-d');

                return [
                    'date' => $date,
                    'total' =>
                        $sales[$date] ?? 0
                ];
            });
    }
}
