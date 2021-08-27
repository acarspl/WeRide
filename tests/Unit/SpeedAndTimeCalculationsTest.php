<?php

namespace Tests\Unit;

use App\Models\Ride;
use Carbon\Carbon;
use Tests\TestCase;

class SpeedAndTimeCalculationsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_average_speed_calculation()
    {
       $this->assertTrue(Ride::calculateAverageSpeed(40, 80)==60);
       $this->assertTrue(Ride::calculateAverageSpeed(30, 30)==30);
       $this->assertTrue(Ride::calculateAverageSpeed(35, 36)==35.5);
    }
}
