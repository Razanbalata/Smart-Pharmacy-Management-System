<?php

namespace App\Http\Controllers\StockMovement;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use App\Services\StockService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use AuthorizesRequests;

    public function history(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $query = StockMovement::with(['product', 'user']);

        if ($request->filled('product')) {
            $query->where('product_id', $request->product);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        $movements = $query->latest()->paginate(20);

        // جلب أنواع الحركات الموجودة فعلياً
        $movementTypes = StockMovement::select('type')
            ->distinct()
            ->pluck('type');

        return view('stock.history', compact(
            'movements',
            'movementTypes'
        ));
    }

    public function showAdjustForm()
    {
        $products = Product::all();

        return view('stock.adjust', compact('products'));
    }

    public function adjust(Request $request, StockService $stockService)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'reason' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        $stockService->adjustStock(
            $product,
            $request->quantity,
            auth()->id(),
            $request->reason
        );

        return back()->with('success', 'Stock adjusted successfully');
    }
}
