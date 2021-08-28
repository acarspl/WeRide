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
    public  $isRace = true;

    public static function indexActive(){
        return Race::where('start_time','>=', Carbon::now())->get();
    }
}

