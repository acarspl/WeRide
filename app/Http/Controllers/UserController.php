<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }
    public function find(Request $request){
        $request->validate([
           'name'=>'required|string|min:3|max:50'
        ]);
        $users = User::where('name','like','%'.$request->name.'%')->take(15)->get(['id','name']);
        session()->flashInput(['name'=>$request->name]);
        return view('user.index',compact('users'));
    }
    public function show(User $user){
        $organizing = ($user->activeRaces()->take(5)->concat($user->activeRides()->take(5)))->sortBy('start_time')->take(5);
        $participating = ($user->participatedRacesActive()->take(5)->concat($user->participatedRidesActive()->take(5)))->sortBy('start_time')->take(5);
        $stats = $user->eventStats();
        return view('user.show',compact('user','organizing','participating','stats'));
    }
}
