<?php

namespace App\Services;

use App\Models\Product;

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

                ->get()

        ];
    }

    public function suggestions(string $term): array
    {
        return Product::query()
            ->where('name', 'like', "%{$term}%")
            ->limit(5)
            ->get()
            ->map(function ($product) {

                return [
                    'title' => $product->name,
                    'subtitle' => $product->scientific_name,
                    'url' => route('products.index', [
                        'search' => $product->name,
                        'highlight' => $product->id
                    ]),
                ];
            })
            ->toArray();
            
    }
}
