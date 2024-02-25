<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected array $cities = [
        ['name' => 'Beograd'],
        ['name' => 'Bor'],
        ['name' => 'Valjevo'],
        ['name' => 'Vranje'],
        ['name' => 'Vršac'],
        ['name' => 'Zaječar'],
        ['name' => 'Zrenjanin'],
        ['name' => 'Jagodina'],
        ['name' => 'Kikinda'],
        ['name' => 'Kragujevac'],
        ['name' => 'Kraljevo'],
        ['name' => 'Kruševac'],
        ['name' => 'Leskovac'],
        ['name' => 'Loznica'],
        ['name' => 'Niš'],
        ['name' => 'Novi Pazar'],
        ['name' => 'Novi Sad'],
        ['name' => 'Pančevo'],
        ['name' => 'Pirot'],
        ['name' => 'Požarevac'],
        ['name' => 'Priština'],
        ['name' => 'Prokuplje'],
        ['name' => 'Smederevo'],
        ['name' => 'Sombor'],
        ['name' => 'Sremska Mitrovica'],
        ['name' => 'Subotica'],
        ['name' => 'Užice'],
        ['name' => 'Čačak'],
        ['name' => 'Šabac']
    ];
    public function run(): void
    {
        foreach ($this->cities as $city) {
            $city["created_at"] = now();
            \App\Models\City::create($city);
        }
    }
}
