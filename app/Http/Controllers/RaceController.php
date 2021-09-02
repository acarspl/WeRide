<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaceRequest;
use App\Models\Race;
use Illuminate\Support\Facades\Auth;

class RaceController extends Controller
{
    public function create(){
        $isRace = true;
        return view('event_management.manage_event',compact('isRace'));
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
        return redirect(route('race.show',$race));
    }
    public function show(Race $race){
        $event = $race;
        $participants = $race->participants()->where('participant_id', '!=',Auth::id())->get(['id','name'])->sortBy('name');
        return view('events.event_view.show', compact(['event','participants']));
    }
    public function join(Race $race){
       return response()->json(['success'=>Auth::user()->joinRace($race)]);
    }
    public function leave(Race $race){
        return response()->json(['success'=>Auth::user()->leaveRace($race)]);
    }
    public function edit(Race $race){
        $isRace = true;
        $event = $race;
        return view('event_management.manage_event',compact('isRace','event'));
    }
    public function update(StoreRaceRequest $request, Race $race){
        $race->fill($request->validated());
        if((is_null($request->get('end_location_lat')) && is_null($request->get('end_location_lng')))){
            $race->end_location_lat = $request->get('start_location_lat');
            $race->end_location_lng = $request->get('start_location_lng');
        }
        $race->save();
        return redirect(route('race.show',$race));
    }
}
