<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private array $categories = [
        [
            'name' => 'Programming',
        ],
        [
            'name' => 'System Administration',
        ],
        [
            'name' => 'Management',
        ],
        [
            'name' => 'QA',
        ],
        [
            'name' => 'Internship',
        ]
    ];
    public function run(): void
    {
        foreach ($this->categories as $category) {
            $category["created_at"] = now();
            \App\Models\Category::create($category);
        }
    }
}
