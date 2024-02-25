<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $workplaces = [
        [
            "name" => "Office",
        ],
        [
            "name" => "Remote",
        ],
        [
            "name" => "Hybrid",
        ],
    ];
    public function run(): void
    {
        foreach ($this->workplaces as $workplace) {
            $workplace["created_at"] = now();
            \App\Models\Workplace::create($workplace);
        }
    }
}
