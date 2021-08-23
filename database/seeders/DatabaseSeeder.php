<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeOfSportSeeder::class,
            UserTypeSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
