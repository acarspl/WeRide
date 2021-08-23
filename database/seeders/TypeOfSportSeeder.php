<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfSportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_sports')->insert([
            'name' => 'Road Cycling',
            'short_name' => 'Cycling',
            'picture' => 'images/types_of_bikes/road_cycling.jpg',
            'description' => 'Experience less air resistance in a group',
            'description_full'=>null,
        ]);
        DB::table('type_of_sports')->insert([
            'name' => 'Gravel Riding',
            'short_name' => 'Gravel',
            'picture' => 'images/types_of_bikes/gravel_ride.jpg',
            'description' => 'Explore unpaved roads and trails with friends',
            'description_full'=>null,
        ]);
        DB::table('type_of_sports')->insert([
            'name' => 'Bike Touring',
            'short_name' => 'Bike Touring',
            'picture' => 'images/types_of_bikes/casual_ride_in_park.jpg',
            'description' => 'Explore cities and nature with others',
            'description_full'=>null,
        ]);
        DB::table('type_of_sports')->insert([
            'name' => 'Mountain Biking (MTB)',
            'short_name' => 'MTB',
            'picture' => 'images/types_of_bikes/mtb.jpg',
            'description' => 'Discover amazing places you never knew existed',
            'description_full'=>null,
        ]);
        DB::table('type_of_sports')->insert([
            'name' => 'Enduro Biking',
            'short_name' => 'Enduro',
            'picture' => 'images/types_of_bikes/enduro.jpg',
            'description' => 'Be faster, improve your technique',
            'description_full'=>null,
        ]);
    }
}
