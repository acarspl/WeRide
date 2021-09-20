<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    public function doesParticipate($event):bool{
        return $event->participants()->where('participant_id',$this->id)->count() === 1;
    }
    public function joinRide(Ride $ride):bool{
        if($ride->user_id != $this->id){
            $this->participatedRides()->save($ride);
            return true;
        }
        return
            false;
    }
    public function leaveRide(Ride $ride):bool{
        return $ride->participants()->where('participant_id',$this->id)->detach();
    }
    public function joinRace(Race $race):bool{
        if($race->user_id != $this->id){
            $this->participatedRaces()->save($race);
            return true;
        }
        return false;
    }
    public function leaveRace(Race $race):bool{
        return $race->participants()->where('participant_id',$this->id)->detach();
    }
    public function eventStats(){
        $stats = (object)[];
        $stats->createdUpcomingRides = $this->activeRides()->count();
        $stats->participatedUpcomingRides = $this->participatedRidesActive()->count();
        $stats->createdUpcomingRaces = $this->activeRaces()->count();
        $stats->participatedUpcomingRaces = $this->participatedRacesActive()->count();
        $stats->createdPastRides = $this->rides()->count() - $this->activeRides()->count();
        $stats->participatedPastRides = $this->participatedRides()->count() - $this->participatedRidesActive()->count();
        $stats->createdPastRaces = $this->races()->count() - $this->activeRaces()->count();
        $stats->participatedPastRaces = $this->participatedRaces()->count() - $this->participatedRacesActive()->count();
        return $stats;
    }
}
