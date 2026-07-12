<?php

namespace App\Services\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\View;

class PdfPreviewService
{
    /**
     * Resolve the provider class based on report type.
     */
    protected function resolveProvider(string $type)
    {
        $providers = config('pdf_reports.providers', []);

        if (! array_key_exists($type, $providers)) {
            throw new Exception("Report type [{$type}] not supported.");
        }

        return app($providers[$type]);
    }

    /**
     * Get the HTML preview for the given report type.
     */
    public function getPreviewHtml(string $type): string
    {
        $provider = $this->resolveProvider($type);
        $data = $provider->getData();

        // Render the shared Blade template to an HTML string
        return View::make('pdf.preview', $data)->render();
    }

    /**
     * Generate and download the PDF for the given report type.
     */
    public function downloadPdf(string $type)
    {
        $provider = $this->resolveProvider($type);
        $data = $provider->getData();

        // Use the exact same blade file used in the preview
        $pdf = Pdf::loadView('pdf.preview', $data);

        // Optional: setup paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        $fileName = $type.'-report-'.date('Y-m-d').'.pdf';

        return $pdf->download($fileName);
    }
}
