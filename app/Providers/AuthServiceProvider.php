<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Supplier;
use App\Policies\ProductPolicy;
use App\Policies\SupplierPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ProvidersAuthServiceProvider;

class AuthServiceProvider extends ProvidersAuthServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
        Supplier::class => SupplierPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
