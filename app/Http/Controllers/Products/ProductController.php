<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Services\StockService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        $query = Product::with(['category', 'supplier']);
        $lowStockProducts = Product::lowStock()->get();
        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('sku', 'like', "%{$request->search}%");
            });
        }

        // Filter by Category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by Supplier
        if ($request->filled('supplier')) {
            $query->where('supplier_id', $request->supplier);
        }

        $products = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.index', compact('products', 'categories', 'suppliers', 'lowStockProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, StockService $stockService)
    {
        $this->authorize('create', Product::class);
        $data = $request->validated();

        $product = Product::create($data);

        // 2. تسجيل المخزون الأولي عبر Service
        if ($data['stock_quantity'] > 0) {
            $stockService->addStock(
                $product,
                $data['stock_quantity'],
                'initial',
                auth()->id(),
                'Initial stock on product creation'
            );
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        if ($product->stock_quantity > 0) {
            return back()->with('error', 'Cannot delete product with stock.');
        }
        $product->delete();

        return redirect()->route('products.index');
    }

    public function lowStock()
    {
        $this->authorize('viewAny', Product::class);

        $products = Product::lowStock()->get();

        return view('products.low-stock', compact('products'));
    }
}
