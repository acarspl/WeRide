<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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
    public static function nearby(int $number){
        $ids= DB::table("rides")->select("rides.id",
            DB::raw("6371 * acos(cos(radians(" .auth()->user()->preferences->location_lat. "))
            * cos(radians(rides.start_location_lat))
            * cos(radians(rides.start_location_lng) - radians(" .auth()->user()->preferences->location_lng. "))
            + sin(radians(" .auth()->user()->preferences->location_lat. "))
            * sin(radians(rides.start_location_lat))) AS distance"))
            ->where('start_time','>=',Carbon::now()->toDateTimeString())
            ->limit($number)
            ->orderBy("distance")
            ->groupBy('rides.id')
            ->get();
        $collection = collect();
        foreach ($ids as $id){
            $collection->push(Ride::find($id->id));
        }
        return $collection;
    }
    public function canJoin(User $user): bool
    {
        return $user->id !== $this->user_id && !$user->doesParticipate($this) &&  $this->signing_deadline >= Carbon::now()
            && ($this->participants()->count() + $this->going_outside_website) < $this->max_users;
    }
}
