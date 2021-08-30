<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/race',[\App\Http\Controllers\RaceController::class, 'index'])->name('race.index');
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/race/create',[\App\Http\Controllers\RaceController::class, 'create'])->name('race.create');
    Route::post('/race',[\App\Http\Controllers\RaceController::class, 'store'])->name('race.store');
    Route::get('/ride/create',[\App\Http\Controllers\RideController::class, 'create'])->name('ride.create');
    Route::post('/ride',[\App\Http\Controllers\RideController::class, 'store'])->name('ride.store');
    Route::get('/events/my',[\App\Http\Controllers\EventController::class,'indexMyEvents'])->name('events.my.index');
    Route::get('/race/{race}',[\App\Http\Controllers\RaceController::class,'show'])->name('race.show');
    Route::get('/ride/{ride}',[\App\Http\Controllers\RideController::class,'show'])->name('ride.show');
    Route::get('/explore',[\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::post('/race/{race}/join',[\App\Http\Controllers\RaceController::class,'join'])->name('race.join')->middleware('can:join,race');
    Route::post('/ride/{ride}/join',[\App\Http\Controllers\RideController::class,'join'])->name('ride.join')->middleware('can:join,ride');
    Route::delete('/race/{race}/leave',[\App\Http\Controllers\RaceController::class,'leave'])->name('race.leave')->middleware('can:leave,race');
    Route::delete('/ride/{ride}/leave',[\App\Http\Controllers\RideController::class,'leave'])->name('ride.leave')->middleware('can:leave,ride');
});
