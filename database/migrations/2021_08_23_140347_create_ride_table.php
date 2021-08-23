<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride', function (Blueprint $table) {
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
            $table->integer('estimated_effort');
            $table->double('distance');
            $table->double('elevation')->default(0);
            $table->text('waypoints')->nullable();
            $table->string('route_link')->nullable();
            $table->integer('going_outside_website')->default(1);
            $table->integer('max_users')->default(64);
            $table->integer('speed_min');
            $table->integer('speed_max');
            $table->dateTime('signing_deadline')->nullable();;
            $table->text('description')->nullable();;
            $table->text('additional_information')->nullable();;
            $table->boolean('helmet_required')->default(true);
            $table->boolean('lights_required')->default(false);




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ride');
    }
}
