<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'type' => 'bronze',
                'duration' => 24,
                'price' => 2.99,

            ],
            [
                'type' => 'silver',
                'duration' => 72,
                'price' => 5.99,
            ],

            [
                'type' => 'gold',
                'duration' => 144,
                'price' => 9.99,
            ],

        ];

        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->type = $sponsor['type'];
            $new_sponsor->duration = $sponsor['duration'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->save();
        }
    }
}
