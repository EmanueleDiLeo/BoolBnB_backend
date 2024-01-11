<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Message;
use App\Models\Apartment;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker){
        for( $i = 0; $i < 5; $i++ ){

            $new_message = new Message();
            $new_message->apartment_id = Apartment::inRandomOrder()->first()->id;
            $new_message->text = $faker->text(255);
            $new_message->sended_at = $faker->date();
            $new_message->sender_email = $faker->email();

            $new_message->save();
        }
    }
}
