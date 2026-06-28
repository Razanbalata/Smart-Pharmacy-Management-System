<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'scientific_name',
        'sku',
        'barcode',
        'description',
        'purchase_price',
        'selling_price',
        'stock_quantity',
        'minimum_stock',
        'expiration_date',
        'batch_number',
        'image',
        'status',
        'category_id',
        'supplier_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // لاحقًا في Stock System
    // public function stockMovements()
    // {
    //     return $this->hasMany(StockMovement::class);
    // }
}
