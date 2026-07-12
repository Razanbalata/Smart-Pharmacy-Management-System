<?php

namespace App\Reports\Providers;

use App\Models\StockMovement;
use App\Reports\Contracts\ReportProviderInterface;

class StockReportProvider implements ReportProviderInterface
{
    public function getData(): array
    {
        $movements = StockMovement::with('product')->orderBy('created_at', 'desc')->limit(200)->get();

        $columns = [
            'date' => 'Date',
            'product' => 'Product',
            'type' => 'Movement Type',
            'quantity' => 'Quantity',
            'reference' => 'Reference',
        ];

        $rows = $movements->map(function ($movement) {
            return [
                'date' => $movement->created_at->format('Y-m-d H:i'),
                'product' => $movement->product ? $movement->product->name : '-',
                'type' => ucfirst($movement->type ?? 'adjustment'),
                'quantity' => $movement->quantity,
                'reference' => $movement->reference ?? '-',
            ];
        })->toArray();

        $summary = [
            'Total Movements' => $movements->count(),
        ];

        return [
            'title' => 'Stock Movements Report',
            'summary' => $summary,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }
}
