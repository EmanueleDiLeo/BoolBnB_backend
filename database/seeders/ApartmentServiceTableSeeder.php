<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Apartment;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {
            $apartment = Apartment::inRandomOrder()->first();
            $service_id = Service::inRandomOrder()->first()->id;
            $apartment->services()->attach($service_id);

        }
    }
}
