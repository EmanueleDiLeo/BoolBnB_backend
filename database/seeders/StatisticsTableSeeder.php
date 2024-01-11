<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Statistic;
use App\Models\Apartment;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        for( $i = 0; $i < 5; $i++ ){
            $new_statistic = new Statistic();
            $new_statistic->apartment_id = Apartment::inRandomOrder()->first()->id;
            $new_statistic->date = $faker->date();
            $new_statistic->ip = $faker->ipv4();
            $new_statistic->save();
        }
    }
}
