<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Services\PurchaseService;
use App\Services\StockService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $orders = PurchaseOrder::with('supplier', 'user')
            ->latest()
            ->get();

        return view('purchase.index', compact('orders'));
    }

    public function create()
    {
        $this->authorize('create', PurchaseOrder::class);
        $suppliers = Supplier::all();
        return view('purchase.create', compact('suppliers'));
    }


    public function store(StorePurchaseRequest $request, PurchaseService $service)
    {
        $this->authorize('create', PurchaseOrder::class);

        $order = $service->createOrder(
            $request->supplier_id,
            auth()->id()
        );

        return redirect()->route('purchase.edit', $order->id);
    }

    public function edit(PurchaseOrder $order)
    {
        $products = Product::all();

        return view('purchase.edit', compact('order', 'products'));
    }

    public function addItem(Request $request, PurchaseOrder $order, PurchaseService $service)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
        ]);

        $service->addItem($order, $request->all());

        return back();
    }

    public function receive(PurchaseOrder $order, StockService $stockService)
    {
        $this->authorize('receive', $order);

        foreach ($order->items as $item) {

            $stockService->addStock(
                $item->product,
                $item->quantity,
                auth()->id(),
                'purchase',
                
            );
        }

        $order->update([
            'status' => 'received'
        ]);

        return back()->with('success', 'Stock updated successfully');
    }
}
