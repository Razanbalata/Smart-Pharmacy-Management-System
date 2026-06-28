<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class InventoryReportService
{
    public function getInventorySummary()
    {
        return [
            'total_products' => Product::count(),

            'low_stock_products' => Product::lowStock()->count(),

            'out_of_stock_products' => Product::where('stock_quantity', 0)->count(),

            'total_stock_units' => Product::sum('stock_quantity'),
        ];
    }

    

    public function getCurrentInventory()
    {
        return Product::with([
            'category',
            'supplier'
        ])
            ->orderBy('name')
            ->paginate(20);
    }

    public function getLowStockProducts()
    {
        return Product::lowStock()
            ->with([
                'category',
                'supplier'
            ])
            ->orderBy('stock_quantity')
            ->get();
    }

    public function getRecentMovements()
    {
        return StockMovement::with([
            'product',
            'user'
        ])
            ->latest()
            ->paginate(20);
    }
}
