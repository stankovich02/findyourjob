<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $companyCities = [
        [
            'company_id' => 1,
            'city_id' => 1,
        ],
        [
            'company_id' => 2,
            'city_id' => 5,
        ],
        [
            'company_id' => 2,
            'city_id' => 23,
        ],
        [
            'company_id' => 3,
            'city_id' => 15,
        ],
        [
            'company_id' => 4,
            'city_id' => 1,
        ],
        [
            'company_id' => 4,
            'city_id' => 17,
        ],
        [
            'company_id' => 5,
            'city_id' => 10,
        ],
        [
            'company_id' => 6,
            'city_id' => 1,
        ],
        [
            'company_id' => 6,
            'city_id' => 7,
        ],
        [
            'company_id' => 6,
            'city_id' => 17,
        ],
        [
            'company_id' => 7,
            'city_id' => 17,
        ],
        [
            'company_id' => 7,
            'city_id' => 4,
        ],
        [
            'company_id' => 8,
            'city_id' => 20,
        ],
        [
            'company_id' => 9,
            'city_id' => 18,
        ],
        [
            'company_id' => 9,
            'city_id' => 1,
        ],
        [
            'company_id' => 10,
            'city_id' => 8,
        ],
        [
            'company_id' => 10,
            'city_id' => 19,
        ],
        [
            'company_id' => 10,
            'city_id' => 25,
        ],
        [
            'company_id' => 11,
            'city_id' => 1,
        ],
        [
            'company_id' => 11,
            'city_id' => 15,
        ],
        [
            'company_id' => 11,
            'city_id' => 17,
        ],
        [
            'company_id' => 12,
            'city_id' => 24,
        ],
        [
            'company_id' => 12,
            'city_id' => 16,
        ],
        [
            'company_id' => 13,
            'city_id' => 10,
        ],
        [
            'company_id' => 14,
            'city_id' => 28,
        ],
        [
            'company_id' => 15,
            'city_id' => 17,
        ],
        [
            'company_id' => 16,
            'city_id' => 1,
        ],
        [
            'company_id' => 17,
            'city_id' => 20,
        ],
        [
            'company_id' => 17,
            'city_id' => 26,
        ],
        [
            'company_id' => 18,
            'city_id' => 1,
        ],
        [
            'company_id' => 19,
            'city_id' => 1,
        ],
        [
            'company_id' => 19,
            'city_id' => 19,
        ]
    ];
    public function run(): void
    {
        foreach ($this->companyCities as $companyCity) {
            $companyCity['created_at'] = now();
            \DB::table('companies_cities')->insert($companyCity);
        }
    }
}
