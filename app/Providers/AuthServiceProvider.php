<?php

namespace App\Providers;

use App\Models\Supplier;
use App\Policies\SupplierPolicy;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Supplier::class => SupplierPolicy::class,
    ];
}
