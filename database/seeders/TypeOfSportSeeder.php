<?php

namespace Database\Seeders;

use App\Models\TypeOfSport;
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

        TypeOfSport::firstOrCreate([
            'name' => 'Road Cycling',
            'short_name' => 'Cycling',
            'picture' => 'images/types_of_bikes/road_cycling.jpg',
            'description' => 'Experience less air resistance in a group',
            'description_full'=>null,
        ]);
       TypeOfSport::firstOrCreate([
            'name' => 'Gravel Riding',
            'short_name' => 'Gravel',
            'picture' => 'images/types_of_bikes/gravel_ride.jpg',
            'description' => 'Explore unpaved roads and trails with friends',
            'description_full'=>null,
        ]);
       TypeOfSport::firstOrCreate([
            'name' => 'Bike Touring',
            'short_name' => 'Bike Touring',
            'picture' => 'images/types_of_bikes/casual_ride_in_park.jpg',
            'description' => 'Explore cities and nature with others',
            'description_full'=>null,
        ]);
       TypeOfSport::firstOrCreate([
            'name' => 'Mountain Biking (MTB)',
            'short_name' => 'MTB',
            'picture' => 'images/types_of_bikes/mtb.jpg',
            'description' => 'Discover amazing places you never knew existed',
            'description_full'=>null,
        ]);
       TypeOfSport::firstOrCreate([
            'name' => 'Enduro Biking',
            'short_name' => 'Enduro',
            'picture' => 'images/types_of_bikes/enduro.jpg',
            'description' => 'Be faster, improve your technique',
            'description_full'=>null,
        ]);
    }
}
