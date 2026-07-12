<?php

namespace App\Reports\Providers;

use App\Models\PurchaseOrder;
use App\Reports\Contracts\ReportProviderInterface;

class PurchaseReportProvider implements ReportProviderInterface
{
    public function getData(): array
    {
        $purchases = PurchaseOrder::with('supplier')->orderBy('created_at', 'desc')->get();

        $columns = [
            'id' => 'Order #',
            'supplier' => 'Supplier',
            'date' => 'Date',
            'status' => 'Status',
            'total' => 'Total Amount',
        ];

        $rows = $purchases->map(function ($purchase) {
            return [
                'id' => $purchase->order_number ?? $purchase->id,
                'supplier' => $purchase->supplier ? $purchase->supplier->name : '-',
                'date' => $purchase->created_at->format('Y-m-d H:i'),
                'status' => ucfirst($purchase->status ?? 'pending'),
                'total' => '$'.number_format($purchase->total_amount ?? 0, 2),
            ];
        })->toArray();

        $summary = [
            'Total Orders' => $purchases->count(),
            'Total Expenses' => '$'.number_format($purchases->sum('total_amount'), 2),
        ];

        return [
            'title' => 'Purchases Report',
            'summary' => $summary,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }
}
