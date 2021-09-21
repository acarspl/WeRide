<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function follow(User $user){
        auth()->user()->follow($user);
        return true;
    }
    public function unfollow(User $user){
        return  auth()->user()->unfollow($user);

    }
}
