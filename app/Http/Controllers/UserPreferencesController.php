<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPreferencesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPreferencesController extends Controller
{
    public function show(){
        $preferences = Auth::user()->preferences;
        return view('user.preferences', compact('preferences'));
    }
    public function update(UpdateUserPreferencesRequest $request){
        $fields = ['road_cycling','gravel','bike_touring','mtb','enduro','metric'];
        $preferences = Auth::user()->preferences;
        foreach ($fields as $field){
            if(isset($request->validated()[$field])){
                $preferences->$field = true;
            }
            else{
                $preferences->$field = false;
            }
        }
        $preferences->location_lat = $request->validated()['start_location_lat'];
        $preferences->location_lng = $request->validated()['start_location_lng'];
        if(isset($request->validated()['avatar'])){
            $request->file('avatar')->storeAs('public/avatars',Auth::id().'.jpg');
        }
        $preferences->save();
        return back();
    }
    public function updateLocation(UpdateUserPreferencesRequest $request):bool{
        $preferences = Auth::user()->preferences;
        $preferences->location_lat = $request->validated()['start_location_lat'];
        $preferences->location_lng = $request->validated()['start_location_lng'];
        $preferences->save();
        return true;
    }
}
