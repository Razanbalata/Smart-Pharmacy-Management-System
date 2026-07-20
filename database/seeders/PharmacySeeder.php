<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::where('email', 'admin@test.com')->first();
         $pharmacy = Pharmacy::create([
            'name' => 'CareFirst Pharmacy Central',
            'owner_id' => $owner->id,
            'owner_name' => $owner->name,
            'phone' => '+970 599 123 456',
            'email' => 'info@carefirst-pharmacy.com',
            'address' => 'Main Street, Al-Najah Building, 2nd Floor, Nablus',
            'license_number' => 'LIC-2026-8849',
            'status' => 'active',
        ]);
        // ربط الأدمن بالصيدلية
        $owner->update([
            'pharmacy_id' => $pharmacy->id,
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
