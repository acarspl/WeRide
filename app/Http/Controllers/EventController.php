<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetEventsWithinBoundsRequest;
use App\Models\Race;
use App\Models\Ride;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function indexMyEvents(){
        $events = Auth::user()->activeRaces()->concat(Auth::user()->activeRides())->sortBy('start_time');
        $events_joined = Auth::user()->participatedRacesActive()->concat( Auth::user()->participatedRidesActive())->sortBy('start_time');
        return view('events.event_view.index_my', compact(['events', 'events_joined']));
    }
    public function index(){
        $events = Race::indexActive()->concat(Ride::indexActive())->sortBy('start_time')->where('user_id','!=',Auth::id());
        return view('events.event_view.index',compact('events'));
    }
    public function indexWithinBounds(GetEventsWithinBoundsRequest $request){ // with filters
        $request = $request->process();
        $events = collect();
        /* is_race:
         * 0 - RIDES & RACES
         * 1 - RIDES ONLY
         * 2 - RACES ONLY
         */
        if($request['is_race'] != 1) {
            $events = $events->concat(Race::getActiveWithinBounds($request['latSW'], $request['lngSW'], $request['latNE'],
                $request['lngNE'])->sportType($request['sport_type'])
                ->startTime('>=', $request['start_time_from'])->startTime('<=', $request['start_time_to'])
                ->distance('>=', $request['distance_from'])->distance('<=', $request['distance_to'])
                ->elevation('>=', $request['elevation_from'])->elevation('<=', $request['elevation_to'])
                ->where('user_id','!=',Auth::id())
                ->take(200)->get());
        }
        if($request['is_race'] != 2) {
            $events = $events->concat(Ride::getActiveWithinBounds($request['latSW'], $request['lngSW'], $request['latNE'],
                $request['lngNE'])->sportType($request['sport_type'])
                ->startTime('>=', $request['start_time_from'])->startTime('<=', $request['start_time_to'])
                ->distance('>=', $request['distance_from'])->distance('<=', $request['distance_to'])
                ->elevation('>=', $request['elevation_from'])->elevation('<=', $request['elevation_to'])
                ->speedLessThan($request['speed_to'])->speedMoreThan($request['speed_from'])
                ->where('user_id','!=',Auth::id())
                ->take(200)->get());
        }
        foreach ($events as $event){
            $event->number_of_participants = $event->numberOfParticipants();
        }
        return $events;
    }
}
