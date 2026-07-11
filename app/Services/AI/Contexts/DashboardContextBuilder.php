<?php

namespace App\Services\AI\Contexts;

use App\Services\AI\Contracts\AIContextBuilder;
use App\Services\DashboardService;

class DashboardContextBuilder implements AIContextBuilder
{
    public function __construct(
        private DashboardService $dashboardService
    ) {}

    public function build(): array
    {
        return [
            'module' => 'dashboard',
            'status' => [
                'level' => $this->dashboardService->calculateStatus(),
                'label' => $this->dashboardService->statusLabel()
            ],
            'summary' => [
                [
                    'title' => 'Sales Today',
                    'message' => '$' . $this->dashboardService->totalSalesToday()
                ],
                [
                    'title' => 'Sales Last 30 Days',
                    'message' => '$' . $this->dashboardService->salesLast30Days()
                ],
                [
                    'title' => 'Purchases Last 30 Days',
                    'message' => '$' . $this->dashboardService->purchasesLast30Days()
                ],
                [
                    'title' => 'Products',
                    'message' => $this->dashboardService->totalProducts()
                ]
            ],
            'metrics' => [
                'profit' =>
                    $this->dashboardService->profitLast30Days(),
                'average_order_value' =>
                    $this->dashboardService->averageOrderValue(),
                'weekly_sales' =>
                    $this->dashboardService->weeklySales(),
                'inventory_value' =>
                    $this->dashboardService->inventoryValue()
            ],
            'alerts' => [
                [
                    'type' => 'low_stock',
                    'level' => 'high',
                    'count' =>
                        $this->dashboardService->lowStockCount()
                ],
                [
                    'type' => 'expired_products',
                    'level' => 'high',
                    'count' =>
                        $this->dashboardService->expiredProductsCount()
                ]
            ],
            'details' => [
                'top_products' =>
                    $this
                        ->dashboardService
                        ->topSellingProducts(),
            ]
        ];
    }
}
