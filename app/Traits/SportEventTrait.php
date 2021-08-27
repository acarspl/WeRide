<?php
namespace App\Traits;
use App\Models\TypeOfSport;
use App\Models\User;

trait SportEventTrait{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function typeOfSport(){
        return $this->belongsTo(TypeOfSport::class,'sport_type_id');
    }
    public function distanceInMiles(){
        return round($this->distance / 1.609,2);
    }
    public function elevationInFeet(){
        return round($this->elevation * 3.281,2);
    }
    public function minSpeedInMilesPerHour(){
        return round($this->speed_min / 1.609,0);
    }
    public function maxSpeedInMilesPerHour(){
        return round($this->speed_max / 1.609,0);
    }

}
