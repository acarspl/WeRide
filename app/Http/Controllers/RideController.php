<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRideRequest;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class RideController extends Controller
{
    public function create(){
        return view('eventManagement.ride.create');
    }
    public function store(StoreRideRequest $request){
        $ride = new Ride();
        $ride->fill($request->validated());
        $ride->user_id = Auth::id();
        $ride->end_time = Ride::calculateEndTime($request->get('distance'), $request->get('start_time'),$request->get('speed_min'), $request->get('speed_max'));
        if((isNull($request->get('end_location_lat')) && isNull($request->get('end_location_lng')))){
            $ride->end_location_lat = $request->get('start_location_lat');
            $ride->end_location_lng = $request->get('start_location_lng');
        }
        $ride->save();
        return back();
        // @TODO TO redirect to view the ride

    }
}
