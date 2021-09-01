<?php


namespace App\Services;


class Units
{
    public static function convertMilesToKilometers($mi){
        if(!$mi){
            return null;
        }
        return $mi*1.609;
    }
    public static function convertFeetToMeters($ft){
        if(!$ft){
            return null;
        }
        return $ft/3.281;
    }
}
