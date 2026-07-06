<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSaleItemRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Traits\BelongsToPharmacy;
use App\Services\SalesService;
use App\Services\StockService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    use AuthorizesRequests;
    //use BelongsToPharmacy;

    public function index()
    {
        $sales = Sale::with('user')
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }
    public function create(SalesService $service)
    {
        $this->authorize('create', Sale::class);
        $sale = $service->createSale(auth()->id());

        return redirect()->route('sales.edit', $sale);
    }

    public function edit(Sale $sale)
    {
        // dd($sale->items);
        $products = Product::where('pharmacy_id', auth()->user()->pharmacy_id)
            ->get();
        // dd($sale);
        $sale->load('items.product');

        return view('sales.edit', compact('sale', 'products'));
    }

    public function addItem(AddSaleItemRequest $request, Sale $sale, SalesService $service)
    {
        $this->authorize('addItem', $sale);


        $product = Product::findOrFail($request->product_id);

        $service->addItem(
            $sale,
            $product,
            $request->quantity
        );

        return back()->with('success', 'Item added successfully');
    }

    public function removeItem(SaleItem $item, SalesService $service)
    {
        $this->authorize('addItem', $item->sale);

        $service->removeItem($item);

        return back()->with('success', 'Item removed successfully.');
    }

    public function complete(Sale $sale, SalesService $service, StockService $stockService)
    {
        $this->authorize('complete', $sale);

        $service->completeSale($sale, $stockService);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale completed successfully.');
    }

    public function cancel(Sale $sale, SalesService $service)
    {
        $this->authorize('cancel', $sale);

        $service->cancelSale($sale);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale cancelled successfully.');
    }
}
