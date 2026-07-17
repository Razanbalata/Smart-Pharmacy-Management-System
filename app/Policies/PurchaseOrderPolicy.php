<?php

namespace App\Policies;

use App\Models\User;

class PurchaseOrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'pharmacist']);
    }

    public function receive(User $user)
    {
        return in_array($user->role, ['admin', 'pharmacist']);
    }
}
