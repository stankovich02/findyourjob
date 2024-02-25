<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $nav = [
        [
            'name' => 'Home',
            'route' => 'home'
        ],
        [
            'name' => 'About',
            'route' => 'about'
        ],
        [
            'name' => 'Jobs',
            'route' => 'jobs.index'
        ],
        [
            'name' => 'Contact',
            'route' => 'contact'
        ],
        [
            'name' => 'Author',
            'route' => 'author'
        ],

    ];
    public function run(): void
    {
        foreach ($this->nav as $nav) {
            $nav["created_at"] = now();
            \App\Models\Nav::create($nav);
        }
    }
}
