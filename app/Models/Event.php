<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
    public static function getActiveWithinBounds(float $latSW,float $lngSW,float $latNE,float $lngNE){
        return parent::where([
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

    public abstract function canJoin(User $user):bool;

    public function removeAllParticipants(){
            foreach($this->participants as $participant) {
                $participant->detach();
            }
    }
    final public static function recommended(int $limit):Collection{
        $recommendedRides = collect();
        $recommendedRaces = collect();
        $following = auth()->user()->following;
        foreach ($following as $follow){
            $recommendedRides =  $recommendedRides->concat($follow->activeRides());
            $recommendedRaces =  $recommendedRaces->concat($follow->activeRaces());
        }
        $recommendedRides = self::filterCollectionToJoinable($recommendedRides);
        $recommendedRaces = self::filterCollectionToJoinable($recommendedRaces);
        if($recommendedRides->count() + $recommendedRaces->count() >= $limit){
            return $recommendedRides->concat($recommendedRaces)->sortBy('start_time')->take($limit)->values();
        }
        foreach ($following as $follow){
            $recommendedRides =  $recommendedRides->concat($follow->participatedRidesActive());
            $recommendedRaces =  $recommendedRaces->concat($follow->participatedRacesActive());
        }
        $recommendedRides =self::filterCollectionToJoinable($recommendedRides)->unique('id');
        $recommendedRaces = self::filterCollectionToJoinable($recommendedRaces)->unique('id');
        if($recommendedRides->count() + $recommendedRaces->count() >= $limit){
            return $recommendedRides->concat($recommendedRaces)->sortBy('start_time')->take($limit)->values();
        }
        $nearbyRides =  self::filterCollectionToJoinable(Ride::nearby($limit))->shuffle();
        $nearbyRaces = self::filterCollectionToJoinable(Race::nearby($limit))->shuffle();
        $recommendedRides = $recommendedRides->concat($nearbyRides)->unique('id');
        $recommendedRaces = $recommendedRaces->concat($nearbyRaces)->unique('id');
        return $recommendedRides->concat($recommendedRaces)->sortBy('start_time')->take($limit)->values();
    }
    private static final function filterCollectionToJoinable(Collection $collection):Collection{
        $recommended = collect();
        foreach ($collection as $event){
            if($event->canJoin(auth()->user())){
                $recommended->push($event);
            }
        }
        return $recommended;
    }
}
