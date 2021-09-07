<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Event
{
    use HasFactory;

    public $table = 'rides';
    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    protected $appends = ['isRace'];
    public function getIsRaceAttribute():bool{
        return false;
    }

    public function calculateEndTime():string{
        $start_time = Carbon::parse($this->start_time);
        $timeInMinutes = ($this->distance*1000)/(self::calculateAverageSpeed($this->speed_min, $this->speed_max)*16.666);
        return $start_time->addMinutes($timeInMinutes)->toDateTimeString();
    }
    public static function calculateAverageSpeed(float $min,float $max):float{
        return ($min+$max)/2;
    }
    public function numberOfParticipants():int{
        return $this->participants()->count() + $this->going_outside_website;
    }
}
