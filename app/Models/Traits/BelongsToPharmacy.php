<?php


namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToPharmacy
{
    protected static function booted()
    {
        static::addGlobalScope('pharmacy', function ($query) {
            if (auth()->check()) {
                $query->where('pharmacy_id', auth()->user()->pharmacy_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->pharmacy_id = auth()->user()->pharmacy_id;
            }
        });
    }
}
