<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;

class SearchService
{
    public function search(string $term): array
    {
        return [

            'products' => Product::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->where(function ($q) use ($term) {

                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($term) . '%'])

                        ->orWhereRaw('LOWER(barcode) LIKE ?', ['%' . strtolower($term) . '%'])

                        ->orWhereRaw('LOWER(sku) LIKE ?', ['%' . strtolower($term) . '%']);
                })

                ->limit(20)

                ->get(),
            'categories' => Category::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($term) . '%'])

                ->limit(20)

                ->get(),
            'suppliers' => Supplier::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($term) . '%'])

                ->limit(20)

                ->get(),
            'users' => User::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($term) . '%'])

                ->limit(20)

                ->get(),
            'sales' => Sale::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->whereRaw('LOWER(invoice_number) LIKE ?', ['%' . strtolower($term) . '%'])

                ->limit(20)

                ->get(),
            'purchases' => PurchaseOrder::query()

                ->where('pharmacy_id', auth()->user()->pharmacy_id)

                ->whereRaw('LOWER(invoice_number) LIKE ?', ['%' . strtolower($term) . '%'])

                ->limit(20)

                ->get()

        ];
    }

    public function suggestions(string $term): array
    {
        $term = strtolower($term);

        $results = [];


        // ==========================
        // Products
        // ==========================

        $products = Product::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->where(function ($q) use ($term) {

                $q->whereRaw('LOWER(name) LIKE ?', ["%{$term}%"])
                    ->orWhereRaw('LOWER(barcode) LIKE ?', ["%{$term}%"])
                    ->orWhereRaw('LOWER(sku) LIKE ?', ["%{$term}%"]);
            })
            ->limit(5)
            ->get();


        foreach ($products as $product) {

            $results[] = [

                'type' => 'Product',

                'icon' => 'inventory_2',

                'title' => $product->name,

                'subtitle' => "SKU: " . $product->sku,

                'url' => route('products.index', [
                    'search' => $product->name,
                    'highlight' => $product->id
                ])

            ];
        }




        // ==========================
        // Categories
        // ==========================

        $categories = Category::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->whereRaw('LOWER(name) LIKE ?', ["%{$term}%"])
            ->limit(5)
            ->get();



        foreach ($categories as $category) {

            $results[] = [

                'type' => 'Category',

                'icon' => 'category',

                'title' => $category->name,

                'subtitle' => 'Category',

                'url' => route('categories.index', [
                    'search' => $category->name,
                    'highlight' => $category->id
                ])

            ];
        }




        // ==========================
        // Suppliers
        // ==========================

        $suppliers = Supplier::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->whereRaw('LOWER(name) LIKE ?', ["%{$term}%"])
            ->limit(5)
            ->get();



        foreach ($suppliers as $supplier) {

            $results[] = [

                'type' => 'Supplier',

                'icon' => 'local_shipping',

                'title' => $supplier->name,

                'subtitle' => 'Supplier',

                'url' => route('suppliers.index', [
                    'search' => $supplier->name,
                    'highlight' => $supplier->id
                ])

            ];
        }


        // ==========================
        // Users
        // ==========================

        $users = User::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->whereRaw('LOWER(name) LIKE ?', ["%{$term}%"])
            ->limit(5)
            ->get();

        foreach ($users as $user) {

            $results[] = [

                'type' => 'User',

                'icon' => 'person',

                'title' => $user->name,

                'subtitle' => 'User',

                'url' => route('users.index', [
                    'search' => $user->name,
                    'highlight' => $user->id
                ])

            ];
        }

        // ==========================
        // Sales
        // ==========================

        $sales = Sale::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->whereRaw('LOWER(id) LIKE ?', ["%{$term}%"])
            ->limit(5)
            ->get();

        foreach ($sales as $sale) {

            $results[] = [

                'type' => 'Sale',

                'icon' => 'receipt',

                'title' => "Invoice: " . $sale->invoice_number,

                'subtitle' => 'Sale',

                'url' => route('sales.index', [
                    'search' => $sale->invoice_number,
                    'highlight' => $sale->id
                ])

            ];
        }

        // ==========================
        // Purchases
        // ==========================

        $purchases = PurchaseOrder::query()
            ->where('pharmacy_id', auth()->user()->pharmacy_id)
            ->whereRaw('LOWER(id) LIKE ?', ["%{$term}%"])
            ->limit(5)
            ->get();

        foreach ($purchases as $purchase) {

            $results[] = [

                'type' => 'Purchase',

                'icon' => 'shopping_cart',

                'title' => "Invoice: " . $purchase->invoice_number,

                'subtitle' => 'Purchase',

                'url' => route('purchase.index', [
                    'search' => $purchase->invoice_number,
                    'highlight' => $purchase->id
                ])

            ];
        }

        return $results;
    }
}
