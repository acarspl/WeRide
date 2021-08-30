<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRideRequest;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function create(){
        $isRace = false;
        return view('event_management.create_event', compact('isRace'));
    }
    public function store(StoreRideRequest $request){
        $ride = new Ride();
        $ride->fill($request->validated());
        $ride->user_id = Auth::id();
        $ride->end_time = $ride->calculateEndTime();
        if((is_null($request->get('end_location_lat')) && is_null($request->get('end_location_lng')))){
            $ride->end_location_lat = $request->get('start_location_lat');
            $ride->end_location_lng = $request->get('start_location_lng');
        }
        $ride->save();
        return back();
        // @TODO TO redirect to view the ride

    }
    public function show(Ride $ride){
        $event = $ride;
        $event->isRace = false;
        return view('events.event_view.show', compact('event'));
    }
    public function join(Ride $ride){
        return response()->json(['success'=>Auth::user()->joinRide($ride)]);
    }
    public function leave(Ride $ride){
        return response()->json(['success'=>Auth::user()->leaveRide($ride)]);
    }
}
