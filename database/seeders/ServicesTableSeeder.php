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
        $data = array (

            array(
                'name'=> 'WiFi',
                'icon'=> 'WiFi.png'
            ),
            array(
                'name'=> 'Posto Macchina',
                'icon'=> 'Parcheggio.png'
            ),
            array(
                'name'=> 'Caffettiera',
                'icon'=> 'Caffettiera.png'
            ),
            array(
                'name'=> 'Asciugacapelli',
                'icon'=> 'Asciugacapelli.png'
            ),
            array(
                'name'=> 'Doccia',
                'icon'=> 'Doccia.png'
            ),
            array(
                'name'=> 'Grucce',
                'icon'=> 'Grucce.png'
            ),
            array(
                'name'=> 'Lavatrice',
                'icon'=> 'Lavatrice.png'
            ),
            array(
                'name'=> 'Palestra',
                'icon'=> 'Palestra.png'
            ),
            array(
                'name'=> 'Servizio in camera',
                'icon'=> 'ServizioCamera.png'
            ),
            array(
                'name'=> 'No fumatori',
                'icon'=> 'VietatoFumare.png'
            ),
            array(
                'name'=> 'Colazione',
                'icon'=> 'Colazione.png'
            ),
            array(
                'name'=> 'Taxi',
                'icon'=> 'Taxi.png'
            ),
            array(
                'name'=> 'TV',
                'icon'=> 'TV.png'
            ),
            array(
                'name'=> 'Videosorveglianza',
                'icon'=> 'Videosorveglianza.png'
            ),
            array(
                'name'=> 'Vasca',
                'icon'=> 'Vasca.png'
            ),
        );
        foreach($data as $service){

            $new_service = new Service();
            $new_service->name = $service['name'];
            $new_service->icon = $service['icon'];
            $new_service->description = $faker->words(3, true);
            $new_service->save();

        }
    }
}
