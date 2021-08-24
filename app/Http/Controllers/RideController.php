<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RideController extends Controller
{
    public function create(){
        return view('eventManagement.ride.create');
    }
}
