<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Race extends Event
{
    use HasFactory;

    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    protected $appends = ['isRace'];
    public function getIsRaceAttribute():bool{
        return true;
    }
    public function numberOfParticipants():int{
        return $this->participants()->count() + 1;
    }
    public static function nearby(int $number){
        $ids= DB::table("races")->select("races.id",
            DB::raw("6371 * acos(cos(radians(" .auth()->user()->preferences->location_lat. "))
            * cos(radians(races.start_location_lat))
            * cos(radians(races.start_location_lng) - radians(" .auth()->user()->preferences->location_lng. "))
            + sin(radians(" .auth()->user()->preferences->location_lat. "))
            * sin(radians(races.start_location_lat))) AS distance"))
            ->where('start_time','>=',Carbon::now()->toDateTimeString())
            ->limit($number)
            ->orderBy("distance")
            ->groupBy('races.id')
            ->get();
        $collection = collect();
        foreach ($ids as $id){
            $collection->push(Race::find($id->id));
        }
        return $collection;
    }
    public function canJoin(User $user): bool
    {        return $user->id !== $this->user_id && !$user->doesParticipate($this) && $this->signing_deadline >= Carbon::now()
            && ($this->participants()->count() + 1) < $this->max_users;
    }
}

