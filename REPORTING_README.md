# PharmaSmart PDF Reporting System

This document outlines the Reusable PDF Preview and Export feature implemented in PharmaSmart.

## Overview
The goal of this system is to provide a unified, reusable, and maintainable way to preview and export PDFs across all modules (Products, Sales, Purchases, Stock, Suppliers) without duplicating business logic or creating a complex reporting engine.

## How it works

1. **User Action:** The user clicks the "Export PDF" button on any list page.
2. **Alpine.js Modal:** An Alpine.js event (`open-pdf-preview`) is dispatched with the report `type` (e.g., `products`, `sales`).
3. **Backend Preview:** The modal sends an AJAX request to `/pdf/preview/{type}`. 
4. **Service Resolution:** The `PdfPreviewService` looks up the `type` in `config/pdf_reports.php` to resolve the correct provider class (e.g., `ProductReportProvider`).
5. **Data Generation:** The Provider queries the database and formats the data into a standard array containing:
   - `title`
   - `summary`
   - `columns`
   - `rows`
6. **HTML Preview:** The service renders the `resources/views/pdf/preview.blade.php` with this data and returns the HTML to the modal.
7. **PDF Download:** If the user clicks "Download PDF", a request is made to `/pdf/download/{type}`, which uses `barryvdh/laravel-dompdf` to convert the exact same HTML view into a downloadable PDF stream.

## Components Created

### 1. Configuration
- `config/pdf_reports.php`: Maps report types to their provider classes.

### 2. Contracts & Providers
- `App\Reports\Contracts\ReportProviderInterface`: The contract all report providers must follow.
- `App\Reports\Providers\ProductReportProvider`
- `App\Reports\Providers\SalesReportProvider`
- `App\Reports\Providers\PurchaseReportProvider`
- `App\Reports\Providers\StockReportProvider`
- `App\Reports\Providers\SupplierReportProvider`

### 3. Service & Controllers
- `App\Services\Pdf\PdfPreviewService`: Core logic for HTML rendering and PDF conversion.
- `App\Http\Controllers\PdfPreviewController`: Handles web requests for previews and downloads.
- `routes/pdf.php`: Registered in `web.php` for `/pdf/*` endpoints.

### 4. Blade Views & Components
- `resources/views/pdf/layouts/report.blade.php`: The master layout for PDFs.
- `resources/views/pdf/preview.blade.php`: The main view passing data to components.
- `resources/views/pdf/components/*`: Reusable components (header, summary, table, footer).
- `resources/views/components/pdf-preview-modal.blade.php`: The Alpine.js modal component inserted into pages.

## How to add a new Report Type

1. Create a new Provider in `App\Reports\Providers` that implements `ReportProviderInterface`.
2. Register the provider mapping in `config/pdf_reports.php`.
3. Add the Export PDF button to the relevant Blade view:
```html
<button onclick="window.dispatchEvent(new CustomEvent('open-pdf-preview', { detail: { type: 'YOUR_TYPE' } }))"
    class="...">
    Export PDF
</button>
```
4. Push the modal component at the bottom of the same Blade view:
```blade
@push('scripts')
    <x-pdf-preview-modal />
@endpush
```
