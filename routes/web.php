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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'welcome']);

Auth::routes(['verify' => true]);

Route::get('/race',[\App\Http\Controllers\RaceController::class, 'index'])->name('race.index');
Route::get('/race/{race}',[\App\Http\Controllers\RaceController::class,'show'])->name('race.show');
Route::get('/events/bounds',[\App\Http\Controllers\EventController::class,'indexWithinBounds'])->name('events.in.bounds');
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/race/create',[\App\Http\Controllers\RaceController::class, 'create'])->name('race.create');
    Route::get('/race/{race}/edit',[\App\Http\Controllers\RaceController::class,'edit'])->name('race.edit')->middleware('can:edit,race');
    Route::patch('/race/{race}',[\App\Http\Controllers\RaceController::class,'update'])->name('race.update')->middleware('can:edit,race');
    Route::post('/race',[\App\Http\Controllers\RaceController::class, 'store'])->name('race.store');
    Route::get('/ride/create',[\App\Http\Controllers\RideController::class, 'create'])->name('ride.create');
    Route::get('/ride/{ride}/edit',[\App\Http\Controllers\RideController::class,'edit'])->name('ride.edit')->middleware('can:edit,ride');
    Route::patch('/ride/{ride}',[\App\Http\Controllers\RideController::class,'update'])->name('ride.update')->middleware('can:edit,ride');
    Route::post('/ride',[\App\Http\Controllers\RideController::class, 'store'])->name('ride.store');
    Route::get('/events/my',[\App\Http\Controllers\EventController::class,'indexMyEvents'])->name('events.my.index');
    Route::get('/ride/{ride}',[\App\Http\Controllers\RideController::class,'show'])->name('ride.show');
    Route::get('/explore',[\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::post('/race/{race}/join',[\App\Http\Controllers\RaceController::class,'join'])->name('race.join')->middleware('can:join,race');
    Route::post('/ride/{ride}/join',[\App\Http\Controllers\RideController::class,'join'])->name('ride.join')->middleware('can:join,ride');
    Route::delete('/race/{race}/leave',[\App\Http\Controllers\RaceController::class,'leave'])->name('race.leave')->middleware('can:leave,race');
    Route::delete('/ride/{ride}/leave',[\App\Http\Controllers\RideController::class,'leave'])->name('ride.leave')->middleware('can:leave,ride');
    Route::delete('/ride/{ride}',[\App\Http\Controllers\RideController::class,'destroy'])->name('ride.destroy')->middleware('can:destroy,ride');
    Route::delete('/race/{race}',[\App\Http\Controllers\RaceController::class,'destroy'])->name('race.destroy')->middleware('can:destroy,race');

    Route::get('/user/preferences',[\App\Http\Controllers\UserPreferencesController::class,'show'])->name('user.preferences.show');
    Route::patch('/user/preferences',[\App\Http\Controllers\UserPreferencesController::class, 'update'])->name('user.preferences.update');
    Route::patch('/user/preferences/location',[\App\Http\Controllers\UserPreferencesController::class, 'updateLocation'])->name('user.preferences.update.location');

});
