<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $userTypes =  array('standard', 'premium', 'admin');

        foreach ($userTypes as $type){
            UserType::firstOrCreate(['name'=> $type]);
        }

    }
}
