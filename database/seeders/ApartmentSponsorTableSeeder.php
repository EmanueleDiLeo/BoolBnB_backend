<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;
use App\Models\Apartment;

class ApartmentSponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for( $i = 0; $i < 5; $i++ ) {
            $apartment= Apartment::inRandomOrder()->first();
            $sponsor_id= Sponsor::inRandomOrder()->first()->id;

            $apartment->sponsors()->attach($sponsor_id);
        }
    }
}
