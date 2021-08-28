<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function indexMyEvents(){
        $races = Auth::user()->activeRaces();
        $rides = Auth::user()->activeRides();
        $events = $races->concat($rides)->sortBy('start_time');
        return view('events.event_view.index_my', compact('events'));
    }
    public function index(){
        $races = Race::indexActive();
        $rides = Ride::indexActive();
        $events = $races->concat($rides)->sortBy('start_time')->where('user_id','!=',Auth::id());
        return view('events.event_view.index',compact('events'));
    }
}
