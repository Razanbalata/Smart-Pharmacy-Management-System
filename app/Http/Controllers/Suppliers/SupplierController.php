<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Supplier::class);
        $query = Supplier::query();
        $suppliers = Supplier::query()->search($request->search)->latest()->paginate(4)->withQueryString();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Supplier::class);

        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $this->authorize('create', Supplier::class);
        Supplier::create($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $this->authorize('update', $supplier);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $this->authorize('update', $supplier);
        $supplier->update($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $this->authorize('delete', $supplier);
        if ($supplier->products()->exists()) {
            return back()->with('error', 'Cannot delete supplier with products.');
        }
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}
