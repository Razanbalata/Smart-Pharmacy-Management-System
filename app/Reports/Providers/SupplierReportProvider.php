<?php

namespace App\Reports\Providers;

use App\Models\Supplier;
use App\Reports\Contracts\ReportProviderInterface;

class SupplierReportProvider implements ReportProviderInterface
{
    public function getData(): array
    {
        $suppliers = Supplier::orderBy('name')->get();

        $columns = [
            'name' => 'Supplier Name',
            'contact_person' => 'Contact Person',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
        ];

        $rows = $suppliers->map(function ($supplier) {
            return [
                'name' => $supplier->name,
                'contact_person' => $supplier->contact_person ?? '-',
                'email' => $supplier->email ?? '-',
                'phone' => $supplier->phone ?? '-',
                'status' => ucfirst($supplier->status ?? 'active'),
            ];
        })->toArray();

        $summary = [
            'Total Suppliers' => $suppliers->count(),
        ];

        return [
            'title' => 'Suppliers Report',
            'summary' => $summary,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }
}
