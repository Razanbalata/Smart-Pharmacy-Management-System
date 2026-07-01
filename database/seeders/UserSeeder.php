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
                'username' => 'pharmacist1',
                'email' => 'pharmacist1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Lina Nasser',
                'username' => 'pharmacist2',
                'email' => 'pharmacist2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Omar Hasan',
                'username' => 'pharmacist3',
                'email' => 'pharmacist3@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'pharmacist',
            ],

            [
                'name' => 'Sara Ali',
                'username' => 'cashier1',
                'email' => 'cashier1@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
            ],

            [
                'name' => 'Mohammad Salem',
                'username' => 'cashier2',
                'email' => 'cashier2@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'cashier',
            ],

            [
                'name' => 'Noor Ahmad',
                'username' => 'cashier3',
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