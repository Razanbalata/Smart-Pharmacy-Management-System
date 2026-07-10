<?php

namespace App\Services\AI;

use App\Services\AI\Contexts\DashboardContextBuilder;
use App\Services\AI\Contexts\ProductContextBuilder;
use App\Services\AI\Contexts\SalesContextBuilder;
use App\Services\AI\Prompts\DashboardPrompt;
use App\Services\AI\Prompts\ProductsPrompt;
use App\Services\AI\Prompts\SalesPrompt;

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
