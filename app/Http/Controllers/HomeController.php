<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Race;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $nearbyRaces = Race::nearby(10)->sortBy('start_time');
        $recommendedEvents = Event::recommended(10);
        $joinedEvents = auth()->user()->participatedRacesActive()->concat(auth()->user()->participatedRidesActive())
            ->concat(auth()->user()->activeRaces())->concat(auth()->user()->activeRides())->sortBy('start_time');

        return view('home',compact('joinedEvents','nearbyRaces','recommendedEvents'));
    }
    public function welcome(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('welcome');

    }
}
