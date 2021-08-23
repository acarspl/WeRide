<?php
namespace App\Traits;
use App\Models\TypeOfSport;
use App\Models\User;

trait SportEventTrait{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function typeOfSport(){
        return $this->belongsTo(TypeOfSport::class,'sport_type_id');
    }

}
