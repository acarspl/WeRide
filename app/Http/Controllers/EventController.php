<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetEventsWithinBoundsRequest;
use App\Models\Race;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function indexMyEvents(){
        $races = Auth::user()->activeRaces();
        $rides = Auth::user()->activeRides();
        $races_joined = Auth::user()->participatedRacesActive();
        $rides_joined  = Auth::user()->participatedRidesActive();
        $events = $races->concat($rides)->sortBy('start_time');
        $events_joined = $races_joined->concat($rides_joined)->sortBy('start_time');
        return view('events.event_view.index_my', compact(['events', 'events_joined']));
    }
    public function index(){
        $races = Race::indexActive();
        $rides = Ride::indexActive();
        $events = $races->concat($rides)->sortBy('start_time')->where('user_id','!=',Auth::id());
        return view('events.event_view.index',compact('events'));
    }
    public function indexWithinBounds(GetEventsWithinBoundsRequest $request){
        $races = Race::getActiveWithinBounds($request->validated()['latSW'],$request->validated()['lngSW'], $request->validated()['latNE'],
            $request->validated()['lngNE'],Auth::user());
        $rides = Ride::getActiveWithinBounds($request->validated()['latSW'],$request->validated()['lngSW'], $request->validated()['latNE'],
            $request->validated()['lngNE'],Auth::user());
        return $races->concat($rides);
    }
}
