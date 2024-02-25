<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
          RoleSeeder::class,
          NavSeeder::class,
          CategorySeeder::class,
          CitySeeder::class,
          CompanySeeder::class,
          TechnologySeeder::class,
          WorkplaceSeeder::class,
          SenioritySeeder::class,
          UserSeeder::class,
          JobSeeder::class,
          JobTechnologySeeder::class,
          CompanyCitySeeder::class,
       ]);
    }
}
