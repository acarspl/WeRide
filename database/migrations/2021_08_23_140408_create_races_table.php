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
            $table->string('name');
            $table->dateTime('start_time');
            $table->double('start_location_lat');
            $table->double('start_location_lng');
            $table->dateTime('end_time');
            $table->double('end_location_lat');
            $table->double('end_location_lng');
            $table->foreignId('sport_type_id')->constrained('type_of_sports','id');
            $table->double('distance');
            $table->double('elevation')->default(0);
            $table->text('waypoints')->nullable();
            $table->string('route_link')->nullable();
            $table->integer('max_users')->nullable();
            $table->dateTime('signing_deadline')->nullable();
            $table->double('price')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->text('additional_information')->nullable();
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
