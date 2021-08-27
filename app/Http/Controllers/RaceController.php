<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaceRequest;
use App\Models\Race;
use Illuminate\Support\Facades\Auth;

class RaceController extends Controller
{
    public function create(){
        $isRace = true;
        return view('event_management.create_event',compact('isRace'));
    }
    public function index(){
        return view('event_management.race.index');
    }
    public function store(StoreRaceRequest $request){
        $race = new Race();
        $race->fill($request->validated());
        $race->user_id = Auth::id();
        if((is_null($request->get('end_location_lat')) && is_null($request->get('end_location_lng')))){
            $race->end_location_lat = $request->get('start_location_lat');
            $race->end_location_lng = $request->get('start_location_lng');
        }
        $race->save();
        return back();
        // @TODO TO redirect to view the ride
    }
}
