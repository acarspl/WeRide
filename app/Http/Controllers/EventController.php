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
    public function indexWithinBounds(GetEventsWithinBoundsRequest $request){ // with filters
        $request = $request->process();
        $events = collect();
        if($request['is_race'] != 1) {
            $events = $events->concat(Race::getActiveWithinBounds($request['latSW'], $request['lngSW'], $request['latNE'],
                $request['lngNE'], Auth::user())->sportType($request['sport_type'])
                ->startTime('>=', $request['start_time_from'])->startTime('<=', $request['start_time_to'])
                ->distance('>=', $request['distance_from'])->distance('<=', $request['distance_to'])
                ->elevation('>=', $request['elevation_from'])->elevation('<=', $request['elevation_to'])
                ->take(200)->get());
        }
        if($request['is_race'] != 2) {
            $events = $events->concat(Ride::getActiveWithinBounds($request['latSW'], $request['lngSW'], $request['latNE'],
                $request['lngNE'], Auth::user())->sportType($request['sport_type'])
                ->startTime('>=', $request['start_time_from'])->startTime('<=', $request['start_time_to'])
                ->distance('>=', $request['distance_from'])->distance('<=', $request['distance_to'])
                ->elevation('>=', $request['elevation_from'])->elevation('<=', $request['elevation_to'])
                ->speedLessThan($request['speed_to'])->speedMoreThan($request['speed_from'])
                ->take(200)->get());
        }
        foreach ($events as $event){
            $event->number_of_participants = $event->numberOfParticipants();
        }
        return $events;
    }
}
