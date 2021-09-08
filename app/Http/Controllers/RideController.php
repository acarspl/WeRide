<?php

namespace App\Http\Controllers;

use App\Http\Requests\RideRequest;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function create(){
        $isRace = false;
        return view('event_management.manage_event', compact('isRace'));
    }
    public function store(RideRequest $request){
        $ride = new Ride();
        $ride->fill($request->validated());
        $ride->user_id = Auth::id();
        $ride->end_time = $ride->calculateEndTime();
        if((is_null($request->get('end_location_lat')) && is_null($request->get('end_location_lng')))){
            $ride->end_location_lat = $request->get('start_location_lat');
            $ride->end_location_lng = $request->get('start_location_lng');
        }
        $ride->save();
        return redirect(route('ride.show',$ride));
    }
    public function show(Ride $ride){
        $event = $ride;
        $participants = $ride->participants()->where('participant_id', '!=',Auth::id())->get(['name','id'])->sortBy('name');
        return view('events.event_view.show', compact(['event','participants']));
    }
    public function join(Ride $ride){
        return response()->json(['success'=>Auth::user()->joinRide($ride)]);
    }
    public function leave(Ride $ride){
        return response()->json(['success'=>Auth::user()->leaveRide($ride)]);
    }
    public function edit(Ride $ride){
        $isRace = false;
        $event = $ride;
        return view('event_management.manage_event', compact('isRace', 'event'));
    }
    public function update(RideRequest $request, Ride $ride){
        $ride->fill($request->validated());
        $ride->end_time = $ride->calculateEndTime();
        if((is_null($request->get('end_location_lat')) && is_null($request->get('end_location_lng')))){
            $ride->end_location_lat = $request->get('start_location_lat');
            $ride->end_location_lng = $request->get('start_location_lng');
        }
        $ride->save();
        return redirect(route('ride.show',$ride));
    }
    public function destroy(Ride $ride){
        $ride->participants()->detach();
        $ride->delete();
        return redirect(route('events.my.index'));
    }
}
