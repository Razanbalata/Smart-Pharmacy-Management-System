<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\PurchaseOrder;

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
        return PurchaseOrder::sum('total_cost');
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
}
