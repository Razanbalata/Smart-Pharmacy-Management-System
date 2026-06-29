<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;

class SalePolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, [
            'admin',
            'cashier',
            'pharmacist',
        ]);
    }

    public function addItem(User $user, Sale $sale): bool
    {
        return $sale->status === 'draft'
            && in_array($user->role, [
                'admin',
                'cashier',
                'pharmacist',
            ]);
    }

    public function complete(User $user, Sale $sale): bool
    {
        return $sale->status === 'draft'
            && in_array($user->role, [
                'admin',
                'cashier',
            ]);
    }

    public function cancel(User $user, Sale $sale): bool
    {
        return $sale->status === 'draft'
            && $user->role === 'admin';
    }
}