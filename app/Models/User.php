<?php

namespace App\Models;

use App\Traits\SportEventTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function type(){
        return $this->belongsTo(UserType::class,'user_type');
    }
    public function preferences(){
        return $this->hasOne(UserPreference::class);
    }
    public function races(){
        return $this->hasMany(Race::class);
    }
    public function activeRaces(){
        return $this->races()->whereDate('start_time','>=', Carbon::now())->get();
    }
    public function rides(){
        return $this->hasMany(Ride::class);
    }
    public function activeRides(){
        return $this->rides()->whereDate('start_time','>=', Carbon::now())->get();
    }
    public function participatedRaces(){
        return $this->morphedByMany(Race::class, 'participated','participants', 'participant_id','participated_id');
    }
    public function participatedRides(){
        return $this->morphedByMany(Ride::class, 'participated','participants','participant_id','participated_id');
    }
    public function participatedRacesActive(){
        return $this->participatedRaces()->where('start_time','>=',Carbon::now())->get();
    }
    public function participatedRidesActive(){
        return $this->participatedRides()->where('start_time','>=',Carbon::now())->get();
    }
    public function doesParticipate($event){
        return $event->participants()->where('participant_id',$this->id)->count() === 1;
    }
    public function joinRide(Ride $ride){
        if($ride->user_id != $this->id){
            $this->participatedRides()->save($ride);
            return true;
        }
        return
            false;
    }
    public function leaveRide(Ride $ride){
        return $ride->participants()->where('participant_id',$this->id)->detach();
    }
    public function joinRace(Race $race){
        if($race->user_id != $this->id){
            $this->participatedRaces()->save($race);
            return true;
        }
        return false;
    }
    public function leaveRace(Race $race){
        return $race->participants()->where('participant_id',$this->id)->detach();
    }
}
