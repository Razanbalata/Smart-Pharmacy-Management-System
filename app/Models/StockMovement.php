<?php

namespace App\Models;

use App\Models\Traits\BelongsToPharmacy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;
    use BelongsToPharmacy;

    protected $fillable = [
        'product_id',
        'pharmacy_id',
        'user_id',
        'type',
        'quantity',
        'reason',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
