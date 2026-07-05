<?php

namespace App\Models;

use App\Models\Traits\BelongsToPharmacy;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use BelongsToPharmacy;
    protected $fillable = [
        'user_id',
        'subtotal',
        'discount',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
