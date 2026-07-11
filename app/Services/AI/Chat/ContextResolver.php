<?php

namespace App\Services\AI\Chat;

use App\Services\AI\Contexts\DashboardContextBuilder;
use App\Services\AI\Contexts\ProductContextBuilder;
use App\Services\AI\Contexts\PurchasesContextBuilder;
use App\Services\AI\Contexts\SalesContextBuilder;
use App\Services\AI\Contexts\StockContextBuilder;
use App\Services\AI\Contexts\SuppliersContextBuilder;

class ContextResolver
{
    private array $builders = [
        'products' =>
            ProductContextBuilder::class,
        'sales' =>
            SalesContextBuilder::class,
        'purchases' =>
            PurchasesContextBuilder::class,
        'suppliers' =>
            SuppliersContextBuilder::class,
        'stock' =>
            StockContextBuilder::class,
        'dashboard' =>
            DashboardContextBuilder::class,
            
    ];

    public function resolve(array $intent): array
    {
        $context = [];

        foreach (
            $intent['contexts'] ?? [] as $name
        ) {
            if (!isset($this->builders[$name])) {
                continue;
            }

            $builder =
                app(
                    $this->builders[$name]
                );

            $context[$name] =
                $builder->build();
        }

        return $context;
    }
}
