<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use App\Models\Statistic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ApartmentsTableSeeder::class,
            MessagesTableSeeder::class,
            ServicesTableSeeder::class,
            ApartmentServiceTableSeeder::class,
            StatisticsTableSeeder::class,
            SponsorsTableSeeder::class,
            ApartmentSponsorTableSeeder::class,
        ]);
    }
}
