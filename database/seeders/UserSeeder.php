<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Mika',
                'last_name' => 'Mikic',
                'email' => 'mika@gmail.com',
                'password' => Hash::make(env('DEFAULT_USER_PASSWORD') . env('CUSTOM_STRING_FOR_HASH')),
                'role_id' => 1,
                'is_active' => true,
                'token' => null,
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Adminic',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD') . env('CUSTOM_STRING_FOR_HASH')),
                'role_id' => 2,
                'is_active' => true,
                'token' => null,
            ]
        ];
        foreach ($users as $user) {
            $user['created_at'] = now();
            \App\Models\User::create($user);
        }
    }
}
