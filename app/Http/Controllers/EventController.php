<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function indexMyEvents(){
        $races = Auth::user()->activeRaces();
        foreach ($races as $race){
            $race->isRace = true;
        }
        $rides = Auth::user()->activeRides();
        foreach ($rides as $ride){
            $ride->isRace = false;
        }
        $events = $races->concat($rides)->sortBy('start_time');
        return view('events.event_view.index_my', compact('events'));
    }
}
