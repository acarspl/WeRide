<?php

namespace App\Models;

use App\Traits\SportEventTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    use SportEventTrait;

    public $table = 'rides';
    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    public function calculateEndTime(){
        $start_time = Carbon::parse($this->start_time);
        $timeInMinutes = ($this->distance*1000)/(self::calculateAverageSpeed($this->speed_min, $this->speed_max)*16.666);
        return $start_time->addMinutes($timeInMinutes)->toDateTimeString();
    }
    public static function calculateAverageSpeed($min, $max){
        return ($min+$max)/2;
    }
}
