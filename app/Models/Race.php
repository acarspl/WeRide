<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}

