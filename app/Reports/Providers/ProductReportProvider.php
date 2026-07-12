<?php

namespace App\Reports\Providers;

use App\Models\Product;
use App\Reports\Contracts\ReportProviderInterface;

class ProductReportProvider implements ReportProviderInterface
{
    public function getData(): array
    {
        // Fetch products, loading related category and supplier
        // In a real scenario, this might call a ProductService to handle filters
        $products = Product::with(['category', 'supplier'])
            ->orderBy('name')
            ->get();

        // Prepare columns
        $columns = [
            'name' => 'Product Name',
            'sku' => 'SKU',
            'category' => 'Category',
            'stock' => 'Stock Qty',
            'price' => 'Price',
            'status' => 'Status',
        ];

        // Prepare rows
        $rows = $products->map(function ($product) {
            return [
                'name' => $product->name,
                'sku' => $product->sku ?? '-',
                'category' => $product->category ? $product->category->name : '-',
                'stock' => $product->stock_quantity,
                'price' => '$'.number_format($product->selling_price, 2),
                'status' => ucfirst($product->status),
            ];
        })->toArray();

        // Prepare summary
        $totalProducts = $products->count();
        $lowStockProducts = $products->where('stock_quantity', '<=', 'minimum_stock')->count(); // simple approximation

        $summary = [
            'Total Products' => $totalProducts,
            'Low Stock' => $lowStockProducts,
        ];

        return [
            'title' => 'Products Report',
            'summary' => $summary,
            'columns' => $columns,
            'rows' => $rows,
        ];
    }
}
