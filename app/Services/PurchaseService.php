<?php

namespace App\Services;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function createOrder($supplierId, $userId)
    {
        return PurchaseOrder::create([
            'supplier_id' => $supplierId,
            'user_id' => $userId,
            'status' => 'pending',
            'total_cost' => 0
        ]);
    }
    public function addItem($order, $data)
    {
        $order->items()->create([
            'product_id' => $data['product_id'],
            'quantity'   => $data['quantity'],
            'cost'       => $data['cost'],
        ]);
        $order->load('items');

        $this->recalculateTotal($order);
    }

    public function recalculateTotal($order)
    {
        $total = $order->items->sum(function ($item) {
            return $item->quantity * $item->cost;
        });
        $order->update(['total_cost' => $total]);
    }
}
