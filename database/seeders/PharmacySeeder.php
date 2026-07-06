<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    public function run(): void
    {
        Pharmacy::create([
            'name' => 'Al-Quds Pharmacy',
            'owner_name' => 'Ahmed Ali',
            'phone' => '0599000001',
            'email' => 'quds@example.com',
            'address' => 'Jerusalem',
            'license_number' => 'LIC-10001',
            'status' => 'active',
        ]);

        Pharmacy::create([
            'name' => 'Al-Shifa Pharmacy',
            'owner_name' => 'Mohammed Hasan',
            'phone' => '0599000002',
            'email' => 'shifa@example.com',
            'address' => 'Gaza',
            'license_number' => 'LIC-10002',
            'status' => 'active',
        ]);
    }
}