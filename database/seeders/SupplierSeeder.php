<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [

            [
                'name' => 'Hikma Pharmaceuticals',
                'contact_person' => 'Hikma Support Team',
                'phone' => '+962 6 580 2900',
                'email' => 'info@hikma.com',
                'address' => 'Amman, Jordan',
                'notes' => 'Major pharmaceutical manufacturer in the region.',
                'status' => 'active',
            ],

            [
                'name' => 'Julphar',
                'contact_person' => 'Customer Service',
                'phone' => '+971 7 246 1461',
                'email' => 'info@julphar.net',
                'address' => 'Ras Al Khaimah, UAE',
                'notes' => 'Specialized in generic medicines.',
                'status' => 'active',
            ],

            [
                'name' => 'Bayer',
                'contact_person' => 'Bayer Healthcare',
                'phone' => '+49 214 30 1',
                'email' => 'contact@bayer.com',
                'address' => 'Leverkusen, Germany',
                'notes' => 'Global life science company.',
                'status' => 'active',
            ],

            [
                'name' => 'Pfizer',
                'contact_person' => 'Pfizer Support',
                'phone' => '+1 212-733-2323',
                'email' => 'info@pfizer.com',
                'address' => 'New York, USA',
                'notes' => 'Research-based pharmaceutical company.',
                'status' => 'active',
            ],

            [
                'name' => 'Sanofi',
                'contact_person' => 'Sanofi Team',
                'phone' => '+33 1 53 77 40 00',
                'email' => 'contact@sanofi.com',
                'address' => 'Paris, France',
                'notes' => 'Global healthcare company.',
                'status' => 'active',
            ],

            [
                'name' => 'Abbott',
                'contact_person' => 'Abbott Support',
                'phone' => '+1 224-667-6100',
                'email' => 'info@abbott.com',
                'address' => 'Illinois, USA',
                'notes' => 'Healthcare and diagnostics company.',
                'status' => 'active',
            ],

            [
                'name' => 'Jamjoom Pharma',
                'contact_person' => 'Sales Department',
                'phone' => '+966 12 654 7000',
                'email' => 'info@jamjoompharma.com',
                'address' => 'Jeddah, Saudi Arabia',
                'notes' => 'Pharmaceutical manufacturing company.',
                'status' => 'active',
            ],

            [
                'name' => 'AstraZeneca',
                'contact_person' => 'Global Support',
                'phone' => '+44 20 3749 5000',
                'email' => 'info@astrazeneca.com',
                'address' => 'Cambridge, UK',
                'notes' => 'Science-led biopharmaceutical company.',
                'status' => 'active',
            ],
        ];

        foreach ($suppliers as $supplier) {

            Supplier::updateOrCreate(
                ['name' => $supplier['name']],
                $supplier
            );
        }
    }
}