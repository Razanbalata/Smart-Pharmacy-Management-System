<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pharmacy.com'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@pharmacy.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
