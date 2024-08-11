<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $countries = ['Italia', 'Francia', 'Germania', 'Spagna', 'Regno Unito'];
    foreach ($countries as $country) {
        \App\Models\Country::create(['name' => $country]);
    }
}
}
