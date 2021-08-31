<?php

namespace App\Models;

use App\Traits\SportEventTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;
    use SportEventTrait;

    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    protected $appends = ['isRace'];
    public function getIsRaceAttribute(){
        return true;
    }

    public static function indexActive(){
        return Race::where('start_time','>=', Carbon::now())->get();
    }
    public function numberOfParticipants(){
        return $this->participants()->count() + 1;
    }
    public static function getActiveRacesWithinBounds($latSW, $lngSW, $latNE, $lngNE, User $user){
        return Race::where([
            ['user_id','!=', $user->id],
            ['start_time','>=', Carbon::now()],
            ['start_location_lat','>=',$latSW],
            ['start_location_lng','>=',$lngSW],
            ['start_location_lat','<=',$latNE],
            ['start_location_lng','<=',$lngNE],
            ])->get();
    }
}

