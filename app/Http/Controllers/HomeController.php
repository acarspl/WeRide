<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\AbstractInline;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }
    public function welcome(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('welcome');

    }
}
