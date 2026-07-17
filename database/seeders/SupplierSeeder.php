<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $pharmacy = Pharmacy::first();

        $suppliers = [
            [
                'name' => 'Hikma Pharmaceuticals',
                'contact_person' => 'Sales Team',
                'phone' => '+96265802900',
                'email' => 'sales@hikma.com',
            ],
            [
                'name' => 'Dar Al Dawa',
                'contact_person' => 'Mohammad Saleh',
                'phone' => '+96265857777',
                'email' => 'info@daraldawa.com',
            ],
            [
                'name' => 'Jerusalem Pharmaceuticals',
                'contact_person' => 'Ahmad Khalil',
                'phone' => '+97022987654',
                'email' => 'contact@jph.com',
            ],
            [
                'name' => 'Roche Medical',
                'contact_person' => 'Roche Support',
                'phone' => '+41216181111',
                'email' => 'support@roche.com',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                ...$supplier,
                'pharmacy_id' => $pharmacy->id,
            ]);
        }
    }
}
