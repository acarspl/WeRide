<?php

namespace App\Models;

use App\Interfaces\CountPeople;
use App\Traits\SportEventTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model implements CountPeople
{
    use HasFactory;
    use SportEventTrait;

    protected $guarded = ['id','user_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time'=> 'datetime','signing_deadline'=>'datetime'];

    protected $appends = ['isRace'];
    public function getIsRaceAttribute(){
        return true;
    }
    public function numberOfParticipants(){
        return $this->participants()->count() + 1;
    }
}

