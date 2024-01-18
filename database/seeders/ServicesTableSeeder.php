<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $data = ['WiFi', 'Posto Macchina', 'Piscina', 'Portineria', 'Sauna', 'Bidet', 'Macchina del caffè', 'Cucina', 'TV', 'Servizio in camera'];
        foreach($data as $service){

            $new_service = new Service();
            $new_service->name = $service;
            $new_service->description = $faker->words(3, true);
            $new_service->save();

        }
    }
}
