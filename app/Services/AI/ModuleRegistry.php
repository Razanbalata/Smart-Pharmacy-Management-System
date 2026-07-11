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
            'description' => 'Overall pharmacy business health',
            'icon' => 'dashboard',
            'color' => 'indigo',
            'context' => DashboardContextBuilder::class,
            'prompt' => DashboardPrompt::class,
        ],
        'products' => [
            'title' => 'Products Intelligence',
            'description' => 'Analyze product performance and inventory',
            'icon' => 'inventory_2',
            'color' => 'green',
            'context' => ProductContextBuilder::class,
            'prompt' => ProductsPrompt::class,
        ],
        'sales' => [
            'title' => 'Sales Intelligence',
            'description' => 'Analyze sales performance and trends',
            'icon' => 'point_of_sale',
            'color' => 'blue',
            'context' => SalesContextBuilder::class,
            'prompt' => SalesPrompt::class,
        ],
        'purchases' => [
            'title' => 'Purchases Intelligence',
            'description' => 'Analyze purchase behavior and supplier relationships',
            'icon' => 'shopping_cart',
            'color' => 'purple',
            'context' => PurchasesContextBuilder::class,
            'prompt' => PurchasesPrompt::class,
        ],
        'suppliers' => [
            'title' => 'Suppliers Intelligence',
            'description' => 'Analyze supplier performance and management',
            'icon' => 'local_shipping',
            'color' => 'orange',
            'context' => SuppliersContextBuilder::class,
            'prompt' => SuppliersPrompt::class,
        ],
        'inventory' => [
            'title' => 'Inventory Intelligence',
            'description' => 'Analyze inventory levels and management',
            'icon' => 'inventory',
            'color' => 'teal',
            'context' => InventoryContextBuilder::class,
            'prompt' => InventoryPrompt::class,
        ],
        'reports' => [
            'title' => 'Reports Intelligence',
            'description' => 'Analyze historical report data',
            'icon' => 'analytics',
            'color' => 'red',
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
