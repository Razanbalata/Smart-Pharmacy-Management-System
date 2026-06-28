<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Services\InventoryReportService;

class InventoryReportController extends Controller
{

    public function dashboard(InventoryReportService $reports)
    {

        $summary = $reports->getInventorySummary();

        return view('dashboard', [
            'summary' => $summary,
            'lowStockProducts' => $reports->getLowStockProducts(),
        ]);
    }
}
