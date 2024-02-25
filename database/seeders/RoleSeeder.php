<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $role = [
        [
            'name' => 'User',
        ],
        [
            'name' => 'Admin',
        ]
    ];
    public function run(): void
    {
        foreach ($this->role as $role) {
            $role["created_at"] = now();
            \App\Models\Role::create($role);
        }
    }
}
