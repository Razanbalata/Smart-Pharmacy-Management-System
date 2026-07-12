<?php

namespace App\Reports\Providers;

use App\Models\Sale;
use App\Reports\Contracts\ReportProviderInterface;

class SalesReportProvider implements ReportProviderInterface
{
    public function getData(): array
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();

        $columns = [
            'id' => 'Invoice #',
            'date' => 'Date',
            'status' => 'Status',
            'total' => 'Total Amount',
        ];

        $rows = $sales->map(function ($sale) {
            return [
                'id' => $sale->invoice_number ?? $sale->id,
                'date' => $sale->created_at->format('Y-m-d H:i'),
                'status' => ucfirst($sale->status ?? 'completed'),
                'total' => '$'.number_format($sale->total_amount ?? 0, 2),
            ];
        })->toArray();

        $summary = [
            'Total Sales' => $sales->count(),
            'Total Revenue' => '$'.number_format($sales->sum('total_amount'), 2),
        ];

        return [
            'title' => 'Sales Report',
            'summary' => $summary,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }
}
