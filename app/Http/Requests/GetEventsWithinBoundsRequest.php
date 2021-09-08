<?php

namespace App\Http\Requests;

use App\Services\Units;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GetEventsWithinBoundsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latSW'=> 'required|numeric',
            'lngSW'=>'required|numeric',
            'latNE'=>'required|numeric',
            'lngNE'=>'required|numeric',
            'is_race'=> 'required|numeric|min:0|max:2',
            'sport_type'=> 'required|numeric|min:0|max:5',
            'start_time_from'=> 'required|date|after:yesterday',
            'start_time_to'=> 'nullable|date',
            'speed_from'=> 'nullable|numeric|min:0|max:55',
            'speed_to'=> 'nullable|numeric|min:0|max:55',
            'distance_from'=> 'nullable|numeric|min:0|max:2000',
            'distance_to'=> 'nullable|numeric|min:0|max:2000',
            'elevation_from'=>'nullable|numeric|min:0|max:90000',
            'elevation_to'=> 'nullable|numeric|min:0|max:90000',
        ];
    }
    public function process(){
        $request = $this->validated();
        if(!Auth::check()){
            $request['is_race'] = 2;
        }
        if(Auth::check() && !Auth::user()->preferences->metric){
            $request['speed_from'] = Units::convertMilesToKilometers($request['speed_from']);
            $request['speed_to'] = Units::convertMilesToKilometers($request['speed_to']);
            $request['distance_from'] = Units::convertMilesToKilometers($request['distance_from']);
            $request['distance_to'] = Units::convertMilesToKilometers($request['distance_to']);
            $request['elevation_from'] = Units::convertFeetToMeters($request['elevation_from']);
            $request['elevation_to'] = Units::convertFeetToMeters($request['elevation_to']);
        }
        if($request['start_time_to']===null){
            $request['start_time_to'] = Carbon::now()->addYear()->toDateTimeString();
        }
        if($request['speed_from']===null){
            $request['speed_from'] = 0;
        }
        if($request['speed_to']===null){
            $request['speed_to'] = 55;
        }
        if($request['distance_from']===null){
            $request['distance_from'] = 0;
        }
        if($request['distance_to']===null){
            $request['distance_to'] = 2000;
        }
        if($request['elevation_from']===null){
            $request['elevation_from'] = 0;
        }
        if($request['elevation_to']===null){
            $request['elevation_to'] = 99999;
        }
        return $request;
    }
}
