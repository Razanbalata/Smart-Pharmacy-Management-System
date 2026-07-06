<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    /** @use HasFactory<\Database\Factories\PharmacyFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'owner_name',
        'phone',
        'email',
        'address',
        'logo',
        'license_number',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
