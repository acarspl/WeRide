<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class Event extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function typeOfSport(){
        return $this->belongsTo(TypeOfSport::class,'sport_type_id');
    }
    public function distanceInMiles():float{
        return round($this->distance / 1.609,2);
    }
    public function elevationInFeet():float{
        return round($this->elevation * 3.281,2);
    }
    public function minSpeedInMilesPerHour():float{
        return round($this->speed_min / 1.609,0);
    }
    public function maxSpeedInMilesPerHour():float{
        return round($this->speed_max / 1.609,0);
    }
    public function startingPointMatchesFinish():bool{
        return $this->start_location_lat === $this->end_location_lat && $this->start_location_lng === $this->end_location_lng;
    }
    public function participants(){
        return $this->morphToMany(User::class,'participated','participants','participated_id','participant_id');
    }
    public function doesUserParticipate(User $user):bool{
        return $this->participants()->where('participant_id',$user->id)->count() === 1;
    }
    public static function getActiveWithinBounds(float $latSW,float $lngSW,float $latNE,float $lngNE, User $user){
        return parent::where([
            ['user_id','!=', $user->id],
            ['start_time','>=', Carbon::now()],
            ['start_location_lat','>=',$latSW],
            ['start_location_lng','>=',$lngSW],
            ['start_location_lat','<=',$latNE],
            ['start_location_lng','<=',$lngNE],
        ])->with('user:id,name','typeOfSport:id,name');
    }
    public static function indexActive(){
        return parent::where('start_time','>=', Carbon::now())->get();
    }
    public function isRoundTrip():bool{
        return ($this->start_location_lat===$this->end_location_lat) && ($this->start_location_lng === $this->end_location_lng);
    }
    public function scopeStartTime($query, $operator, $dateTime){
        return $query->where('start_time',$operator,$dateTime);
    }
    public function scopeDistance($query, $operator, $distance){
        return $query->where('distance',$operator,$distance);
    }
    public function scopeElevation($query, $operator, $elevation){
        return $query->where('elevation',$operator,$elevation);
    }
    public function scopeSportType($query, $type){
        if($type==0){ // show all types
            return $query->where('sport_type_id','>',$type);
        }
        return $query->where('sport_type_id',$type);
    }
    public function scopeSpeedLessThan($query, $speed){
        return $query->where('speed_min', '<=', $speed);
    }
    public function scopeSpeedMoreThan($query, $speed){
        return $query->where('speed_max', '>=', $speed);
    }
    public abstract function numberOfParticipants():int;
}
