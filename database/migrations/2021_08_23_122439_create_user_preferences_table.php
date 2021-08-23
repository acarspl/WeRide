<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sports = ['road_cycling','gravel','bike_touring','mtb','enduro'];
        Schema::create('user_preferences', function (Blueprint $table) use ($sports) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            foreach ($sports as $sport){
                $table->boolean($sport)->default(true);
            }
            $table->double('location_lat')->nullable();
            $table->double('location_lng')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_preferences');
    }
}
