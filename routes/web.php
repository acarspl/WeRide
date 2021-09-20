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

Route::middleware(['auth','verified'])->group(function(){
    //Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Race Management
    Route::prefix('race')->group(function (){
        Route::get('/create',[\App\Http\Controllers\RaceController::class,'create'])->name('race.create');
        Route::get('/{race}/edit',[\App\Http\Controllers\RaceController::class,'edit'])->name('race.edit')->middleware('can:edit,race');
        Route::patch('/{race}',[\App\Http\Controllers\RaceController::class,'update'])->name('race.update')->middleware('can:edit,race');
        Route::post('/',[\App\Http\Controllers\RaceController::class, 'store'])->name('race.store');
        Route::delete('/{race}',[\App\Http\Controllers\RaceController::class,'destroy'])->name('race.destroy')->middleware('can:destroy,race');
        //join/leave race
        Route::post('/{race}/join',[\App\Http\Controllers\RaceController::class,'join'])->name('race.join')->middleware('can:join,race');
        Route::delete('/{race}/leave',[\App\Http\Controllers\RaceController::class,'leave'])->name('race.leave')->middleware('can:leave,race');
    });
    //Ride Management
    Route::prefix('ride')->group(function (){
        Route::get('/create',[\App\Http\Controllers\RideController::class, 'create'])->name('ride.create');
        Route::get('/{ride}/edit',[\App\Http\Controllers\RideController::class,'edit'])->name('ride.edit')->middleware('can:edit,ride');
        Route::patch('/{ride}',[\App\Http\Controllers\RideController::class,'update'])->name('ride.update')->middleware('can:edit,ride');
        Route::post('/',[\App\Http\Controllers\RideController::class, 'store'])->name('ride.store');
        Route::get('/{ride}',[\App\Http\Controllers\RideController::class,'show'])->name('ride.show');
        Route::delete('/{ride}',[\App\Http\Controllers\RideController::class,'destroy'])->name('ride.destroy')->middleware('can:destroy,ride');
        //join/leave ride
        Route::post('/{ride}/join',[\App\Http\Controllers\RideController::class,'join'])->name('ride.join')->middleware('can:join,ride');
        Route::delete('/{ride}/leave',[\App\Http\Controllers\RideController::class,'leave'])->name('ride.leave')->middleware('can:leave,ride');
    });

    //Event Management
    Route::get('/events/my',[\App\Http\Controllers\EventController::class,'indexMyEvents'])->name('events.my.index');
    Route::get('/explore',[\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    // User Preferences
    Route::prefix('/user/preferences')->group(function (){
        Route::get('/',[\App\Http\Controllers\UserPreferencesController::class,'show'])->name('user.preferences.show');
        Route::patch('/',[\App\Http\Controllers\UserPreferencesController::class, 'update'])->name('user.preferences.update');
        Route::patch('/location',[\App\Http\Controllers\UserPreferencesController::class, 'updateLocation'])->name('user.preferences.update.location');
    });
    //Users
    Route::prefix('/user')->group(function(){
       Route::get('/',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
       Route::get('/find',[\App\Http\Controllers\UserController::class,'find'])->name('users.find');
       Route::get('/{user}',[App\Http\Controllers\UserController::class,'show'])->name('users.show');
    });
});
// Guest Routes
Route::get('/race',[\App\Http\Controllers\RaceController::class, 'index'])->name('race.index');
Route::get('/race/{race}',[\App\Http\Controllers\RaceController::class,'show'])->name('race.show');
Route::get('/events/bounds',[\App\Http\Controllers\EventController::class,'indexWithinBounds'])->name('events.in.bounds');
