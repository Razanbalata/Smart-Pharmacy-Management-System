<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            [
                'name' => 'Ahmad Khalil',
                'email' => 'pharmacist1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Lina Nasser',
                'email' => 'pharmacist2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Omar Hasan',
                'email' => 'pharmacist3@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Sara Ali',
                'email' => 'cashier1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
            ],

            [
                'name' => 'Mohammad Salem',
                'email' => 'cashier2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
            ],

            [
                'name' => 'Noor Ahmad',
                'email' => 'cashier3@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
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