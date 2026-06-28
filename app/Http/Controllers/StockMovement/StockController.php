<?php

namespace App\Http\Controllers\StockMovement;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
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

        return view('stock.history', compact('movements'));
    }
}
