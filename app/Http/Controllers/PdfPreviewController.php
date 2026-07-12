<?php

namespace App\Http\Controllers;

use App\Services\Pdf\PdfPreviewService;
use Illuminate\Http\Request;

class PdfPreviewController extends Controller
{
    protected $pdfService;

    public function __construct(PdfPreviewService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Return the HTML preview of the report.
     */
    public function preview(Request $request, $type)
    {
        try {
            $html = $this->pdfService->getPreviewHtml($type);

            return response()->json([
                'html' => $html,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Download the generated PDF file.
     */
    public function download(Request $request, $type)
    {
        try {
            return $this->pdfService->downloadPdf($type);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: '.$e->getMessage());
        }
    }
}
