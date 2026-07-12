<?php

use App\Reports\Providers\ProductReportProvider;
use App\Reports\Providers\PurchaseReportProvider;
use App\Reports\Providers\SalesReportProvider;
use App\Reports\Providers\StockReportProvider;
use App\Reports\Providers\SupplierReportProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | PDF Report Providers Mapping
    |--------------------------------------------------------------------------
    |
    | This array maps report types (keys) to their corresponding Provider classes.
    | When a user requests a PDF preview/download for a specific type, the
    | PdfPreviewService will instantiate the class defined here to fetch data.
    |
    */

    'providers' => [
        'products' => ProductReportProvider::class,
        'sales' => SalesReportProvider::class,
        'purchases' => PurchaseReportProvider::class,
        'stock' => StockReportProvider::class,
        'suppliers' => SupplierReportProvider::class,
    ],
];
