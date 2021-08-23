<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('event_start_time');
            $table->double('start_location_lat');
            $table->double('start_location_lng');
            $table->dateTime('event_end_time');
            $table->double('end_location_lat');
            $table->double('end_location_lng');
            $table->foreignId('sport_type_id')->constrained('type_of_sports','id');
            $table->double('distance');
            $table->double('elevation');
            $table->text('waypoints');
            $table->string('route_link');
            $table->integer('max_users');
            $table->dateTime('signing_deadline');
            $table->double('price');
            $table->text('description');
            $table->text('requirements');
            $table->text('additional_information');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
