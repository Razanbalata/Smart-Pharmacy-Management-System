<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class InventoryReportService
{
    // public function getInventorySummary()
    // {
    //     return [
    //         'total_products' => Product::count(),

    //         'low_stock_products' => Product::lowStock()->count(),

    //         'out_of_stock_products' => Product::where('stock_quantity', 0)->count(),

    //         'total_stock_units' => Product::sum('stock_quantity'),
    //     ];
    // }



    // public function getCurrentInventory()
    // {
    //     return Product::with([
    //         'category',
    //         'supplier'
    //     ])
    //         ->orderBy('name')
    //         ->paginate(20);
    // }

    // public function getLowStockProducts()
    // {
    //     return Product::lowStock()
    //         ->with([
    //             'category',
    //             'supplier'
    //         ])
    //         ->orderBy('stock_quantity')
    //         ->get();
    // }

    // public function getRecentMovements()
    // {
    //     return StockMovement::with([
    //         'product',
    //         'user'
    //     ])
    //         ->latest()
    //         ->paginate(20);
    // }

    private function products()
    {
        return Product::where('pharmacy_id', auth()->user()->pharmacy_id);
    }

    public function currentStock()
    {
        return $this->products()->count();
    }

    public function lowStockCount()
    {
        return $this->products()
            ->whereColumn('stock_quantity', '<=', 'minimum_stock')
            ->count();
    }


    public function lowStockProducts()
    {
        return $this->products()
            ->whereColumn('stock_quantity', '<=', 'minimum_stock')
            ->with(['category', 'supplier'])
            ->limit(5)
            ->get();
    }

    public function outOfStock()
    {
        return $this->products()
            ->where('stock_quantity', 0)
            ->count();
    }

    public function expiringSoon()
    {
        return $this->products()
            ->whereBetween('expiration_date', [
                now(),
                now()->addDays(30)
            ])
            ->count();
    }

    public function expiringProducts()
    {
        return $this->products()
            ->whereBetween('expiration_date', [
                now(),
                now()->addDays(30)
            ])
            ->limit(5)
            ->get();
    }

    public function expired()
    {
        return $this->products()
            ->whereDate('expiration_date', '<', today())
            ->count();
    }

    public function inventoryValue()
    {
        return $this->products()
            ->selectRaw('SUM(stock_quantity * purchase_price) as total')
            ->value('total') ?? 0;
    }
}
