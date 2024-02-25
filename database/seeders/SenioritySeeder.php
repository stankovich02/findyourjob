<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $seniorities = [
        [
            "name" => "Junior",
        ],
        [
            "name" => "Medior",
        ],
        [
            "name" => "Senior",
        ],
    ];
    public function run(): void
    {
        foreach ($this->seniorities as $seniority) {
            $seniority["created_at"] = now();
            \App\Models\Seniority::create($seniority);
        }
    }
}
