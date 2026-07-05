<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{



    public function run(): void
    {
        $pharmacy = Pharmacy::first();
        $users = [

        [
                'name' => 'Ahmad Khalil',
                'email' => 'pharmacist1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'pharmacy_id' => $pharmacy->id,
            ],
            [
                'name' => 'Ahmad Khalil',
                'email' => 'pharmacist1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Lina Nasser',
                'email' => 'pharmacist2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Omar Hasan',
                'email' => 'pharmacist3@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Sara Ali',
                'email' => 'cashier1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Mohammad Salem',
                'email' => 'cashier2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
                'pharmacy_id' => $pharmacy->id,
            ],

            [
                'name' => 'Noor Ahmad',
                'email' => 'cashier3@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
                'pharmacy_id' => $pharmacy->id,
            ],
        ];

        foreach ($users as $user) {

            User::updateOrCreate(

                ['email' => $user['email']],

                $user

            );
        }
    }
}
