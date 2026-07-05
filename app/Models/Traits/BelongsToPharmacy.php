<?php


namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToPharmacy
{
    protected static function bootBelongsToPharmacy()
    {
        static::addGlobalScope('pharmacy', function (Builder $builder) {
            if (pharmacy_id()) {
                $builder->where('pharmacy_id', pharmacy_id());
            }
        });

        static::creating(function ($model) {
            if (pharmacy_id()) {
                $model->pharmacy_id = pharmacy_id();
            }
        });
    }
}
