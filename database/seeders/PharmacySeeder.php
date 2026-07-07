<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::where('email', 'admin@pharmacy.com')->first();
        Pharmacy::create([
            'name' => 'Al-Quds Pharmacy',
            'owner_id' => $owner->id,
            'owner_name' => $owner->name,
            'phone' => '0599000001',
            'email' => 'quds@example.com',
            'address' => 'Jerusalem',
            'license_number' => 'LIC-10001',
            'status' => 'active',
        ]);

        // Pharmacy::create([
        //     'name' => 'Al-Shifa Pharmacy',
        //     'owner_id' => $owner->id,
        //     'owner_name' => $owner->name,
        //     'phone' => '0599000002',
        //     'email' => 'shifa@example.com',
        //     'address' => 'Gaza',
        //     'license_number' => 'LIC-10002',
        //     'status' => 'active',
        // ]);
    }
}
