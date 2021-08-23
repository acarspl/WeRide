<?php

namespace Database\Factories;

use App\Models\Ride;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ride::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time'=>Carbon::now()->addHour(),
            'start_location_lat'=> 52.22907312,
            'start_location_lng'=>21.008567,
            'end_time'=>Carbon::now()->addHours(5),
            'end_location_lat'=> 52.22907312,
            'end_location_lng'=>21.008567,
            'sport_type_id' => 1,
            'estimated_effort'=>3,
            'distance' => random_int(1,100),
            'speed_min' => 30,
            'speed_max' => 35,
        ];
    }
    public function past()
    {
        return $this->state(function (array $attributes) {
            return [
                'start_time' => Carbon::now()->subDays(3),
                'end_time' => Carbon::now()->subDays(3)->addHour(),
            ];
        });
    }
}