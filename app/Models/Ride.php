<?php

namespace App\Models;

use App\Traits\SportEventTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Ride extends Model
{
    use HasFactory;
    use SportEventTrait;

    public $table = 'rides';
    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    public static function calculateEndTime($distance, $start_time, $min_speed, $max_speed){
        $start_time = Carbon::parse($start_time);
        $timeInMinutes = ($distance*1000)/(self::calculateAverageSpeed($min_speed, $max_speed)*16.666);
        return $start_time->addMinutes($timeInMinutes)->toDateTimeString();
    }
    public static function calculateAverageSpeed($min, $max){
        return ($min+$max)/2;
    }
}
