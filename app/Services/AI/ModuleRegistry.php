<?php

namespace App\Services\AI;

use App\Services\AI\Contexts\DashboardContextBuilder;
use App\Services\AI\Contexts\InventoryContextBuilder;
use App\Services\AI\Contexts\ProductContextBuilder;
use App\Services\AI\Contexts\PurchasesContextBuilder;
use App\Services\AI\Contexts\ReportsContextBuilder;
use App\Services\AI\Contexts\SalesContextBuilder;
use App\Services\AI\Contexts\SuppliersContextBuilder;
use App\Services\AI\Prompts\DashboardPrompt;
use App\Services\AI\Prompts\InventoryPrompt;
use App\Services\AI\Prompts\ProductsPrompt;
use App\Services\AI\Prompts\PurchasesPrompt;
use App\Services\AI\Prompts\ReportsPrompt;
use App\Services\AI\Prompts\SalesPrompt;
use App\Services\AI\Prompts\SuppliersPrompt;

class ModuleRegistry
{
    private array $modules = [
        'dashboard' => [
            'title' => 'Dashboard Analysis',
            'icon' => 'dashboard',
            'context' => DashboardContextBuilder::class,
            'prompt' => DashboardPrompt::class,
        ],
        'products' => [
            'title' => 'Products Intelligence',
            'icon' => 'inventory_2',
            'context' => ProductContextBuilder::class,
            'prompt' => ProductsPrompt::class,
        ],
        'sales' => [
            'title' => 'Sales Intelligence',
            'icon' => 'point_of_sale',
            'context' => SalesContextBuilder::class,
            'prompt' => SalesPrompt::class,
        ],
        'purchases' => [
            'title' => 'Purchases Intelligence',
            'icon' => 'shopping_cart',
            'context' => PurchasesContextBuilder::class,
            'prompt' => PurchasesPrompt::class,
        ],
        'suppliers' => [
            'title' => 'Suppliers Intelligence',
            'icon' => 'local_shipping',
            'context' => SuppliersContextBuilder::class,
            'prompt' => SuppliersPrompt::class,
        ],
        'inventory' => [
            'title' => 'Inventory Intelligence',
            'icon' => 'inventory',
            'context' => InventoryContextBuilder::class,
            'prompt' => InventoryPrompt::class,
        ],
        'reports' => [
            'title' => 'Reports Intelligence',
            'icon' => 'analytics',
            'context' => ReportsContextBuilder::class,
            'prompt' => ReportsPrompt::class,
        ],
    ];

    public function get(string $module): array
    {
        $module = strtolower($module);
        if (!isset($this->modules[$module])) {
            throw new \Exception(
                "AI Module [$module] not registered"
            );
        }

        return $this->modules[$module];
    }

    public function all(): array
    {
        return $this->modules;
    }
}
