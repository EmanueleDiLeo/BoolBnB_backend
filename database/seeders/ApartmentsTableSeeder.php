<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Functions\Helper;
use App\Models\User;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'title' => 'Grace\'s Home B&B Affittacamere ',
                'slug' => '',
                'room_number' => '3',
                'bed_number' => '5',
                'bathroom_number' => '3',
                'sq_metres' => '150',
                'img' => 'https://a0.muscache.com/im/pictures/miso/Hosting-994728480993840392/original/c940cb30-b4ab-47da-afd0-e0d13384a25d.jpeg?im_w=960',
                'address' => 'Via Calogero Sacheli 15, Canicattì',
                'lon' => '37.35436',
                'lat' => '13.84693',
                'visible' => '1',
                'user_id' => '1'
            ),
            array(
                'title' => 'Casa Vacanze "Bellezza del Sud"',
                'slug' => '',
                'room_number' => '1',
                'bed_number' => '1',
                'bathroom_number' => '1',
                'sq_metres' => '70',
                'img' => 'https://a0.muscache.com/im/pictures/hosting/Hosting-994277226320362968/original/49cf6742-ed06-4f8f-8411-705bb81c6a4f.jpeg?im_w=960',
                'address' => 'Via Benedetto Cairoli 2, Canicattì',
                'lon' => '37.35668',
                'lat' => '13.84859',
                'visible' => '1',
                'user_id' => '1'
            ),
            array(
                'title' => 'Attico vista mare tra la scala & la valle.',
                'slug' => '',
                'room_number' => '3',
                'bed_number' => '5',
                'bathroom_number' => '1',
                'sq_metres' => '120',
                'img' => 'https://a0.muscache.com/im/pictures/a176fc41-2765-47c2-b49d-824b20f60ed5.jpg?im_w=960',
                'address' => 'Viale Crispi 100, Porto Empedocle',
                'lon' => '37.28753',
                'lat' => '13.52342',
                'visible' => '1',
                'user_id' => '1'
            ),
            array(
                'title' => 'Royal Apartment 101 in centro',
                'slug' => '',
                'room_number' => '2',
                'bed_number' => '2',
                'bathroom_number' => '1',
                'sq_metres' => '105',
                'img' => 'https://a0.muscache.com/im/pictures/807f8439-e0ba-4cd4-b716-1fd1532a1903.jpg?im_w=960',
                'address' => 'Via Celeste 21, Catania',
                'lon' => '37.50878',
                'lat' => '15.09327',
                'visible' => '1',
                'user_id' => '1'
            ),
            array(
                'title' => 'Casa Gonzaga',
                'slug' => '',
                'room_number' => '1',
                'bed_number' => '2',
                'bathroom_number' => '1',
                'sq_metres' => '80',
                'img' => 'https://a0.muscache.com/im/pictures/miso/Hosting-604037731435080110/original/a710a09a-8037-48b3-bbbb-2c07f09cf5a2.jpeg?im_w=1200',
                'address' => 'Via Noviziato Casazza 20, Messina',
                'lon' => '38.19394',
                'lat' => '15.53464',
                'visible' => '1',
                'user_id' => '1'
            )
        );

        foreach ($data as $apartment) {
            Apartment::create([
                'title' => $apartment['title'],
                'slug' => Helper::generateSlug($apartment['title'], Apartment::class),
                'room_number' => $apartment['room_number'],
                'bed_number' => $apartment['bed_number'],
                'bathroom_number' => $apartment['bathroom_number'],
                'sq_metres' => $apartment['sq_metres'],
                'img' => $apartment['img'],
                'address' => $apartment['address'],
                'lon' => $apartment['lon'],
                'lat' => $apartment['lat'],
                'visible' => $apartment['visible'],
                'user_id' => User::inRandomOrder()->first()->id
            ]);
        }
    }
}
