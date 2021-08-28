@extends('layouts.app')

@section('content')
    <div class="container col-12 col-md-9 col-lg-8 col-xl-6">
        <div class="card mt-2 mx-auto text-center">
            <div class="card-header bg-green mx-0  text-white font-weight-bold">
                <img class="mb-2 mt-2" @if($event->isRace) src="{{asset('images/icons/map/race_flag.png')}}" alt="Race"  @else src="{{asset('images/logo/bike.png')}}" alt="Ride" @endif style="width: 20px" >
                <span class="font-weight-bold mx-2 ">{{$event->name}}</span>
                @if($event->user_id == Auth::id())
                    <a class="btn btn-primary float-right" type="button" href="#">
                        &#128295; Edit</a>
                    @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 font-weight-bold">
                                Start Location
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                @include('events.components.location_map',['iteration'=>1, 'lat'=>$event->start_location_lat, 'lng'=>$event->start_location_lng, 'height'=>350])
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        @if($event->startingPointMatchesFinish())
                            <div class="row mt-3">
                                <h3 class="font-weight-bold col-12 mt-4 mb-4">
                                    &#10227; Round Trip
                                </h3>
                            </div>
                            @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="@if($event->startingPointMatchesFinish()) col-12 @else col-7  @endif mx-0 mb-1 px-0 bg-black mx-auto round-all-edges"  style="position: relative;">
                                    <img class="fadedImage round-all-edges" src="{{asset($event->typeOfSport->picture)}}" alt="{{$event->typeOfSport->name}}" style="width: 100%; position: relative">
                                    <h4 class="overlayTextCenter py-2 text-white text-center col-12">{{$event->typeOfSport->name}}</h4>
                                </div>
                            </div>
                        </div>
                        @if(!$event->startingPointMatchesFinish())
                        <div class="row">
                            <div class="col-12 mt-2 font-weight-bold">
                                Finish Location
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                        @include('events.components.location_map',['iteration'=>2, 'lat'=>$event->end_location_lat, 'lng'=>$event->end_location_lng, 'height'=>200])
                            </div>
                        </div>
                            @endif

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="mx-auto col-12 col-md-8 col-xl-6">
                        <table class="table table-sm ">
                            <tbody>
                            @if($event->user->id != \Illuminate\Support\Facades\Auth::id())
                            <tr>
                                <th>Organizer</th>
                                <td>{{$event->user->name}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Start</th>
                                <td>{{\Carbon\Carbon::parse($event->start_time)->format('d-m-Y H:i')}}</td>
                            </tr>
                            <tr>
                                <th>Ends At @if(!$event->isRace)(estimated)@endif</th>
                                <td>{{\Carbon\Carbon::parse($event->end_time)->format('d-m-Y H:i')}}</td>
                            </tr>
                            <tr>
                                <th>Distance</th>
                                <td>
                                @if(Auth::user()->preferences->metric)
                                    {{$event->distance}} km
                                @else
                                    {{$event->distanceInMiles()}} mi
                                @endif
                                </td>
                            </tr>
                            @if($event->elevation != 0)
                                <tr>
                                    <th>Elevation</th>
                                    <td>
                                        @if(Auth::user()->preferences->metric)
                                            {{$event->elevation}} m
                                        @else
                                            {{$event->elevationInFeet()}} ft
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if($event->route_link)
                                <tr>
                                    <th>Route</th>
                                    <td><a href="{{$event->route_link}}">{{$event->route_link}}</a> </td>
                                </tr>
                                @endif
                            @if(!$event->isRace)
                            <tr>
                                <th>Speed</th>
                                <td>
                                    @if(Auth::user()->preferences->metric)
                                        @if($event->speed_min == $event->speed_max)
                                            {{$event->speed_min}} kph
                                        @else
                                            {{$event->speed_min.'-'.$event->speed_max}} kph
                                        @endif
                                    @else
                                        @if($event->minSpeedInMilesPerHour() == $event->maxSpeedInMilesPerHour())
                                            {{$event->minSpeedInMilesPerHour()}} mph
                                        @else
                                            {{$event->minSpeedInMilesPerHour().'-'.$event->maxSpeedInMilesPerHour()}} mph
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Estimated Effort</th>
                                <td>{{$event->estimated_effort.' / 5'}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Max users</th>
                                <td>{{$event->max_users}}</td>
                            </tr>
                            <tr>
                                <th>Signing Deadline</th>
                                <td>{{\Carbon\Carbon::parse($event->signing_deadline)->format('d-m-Y H:i')}}</td>
                            </tr>
                            @if($event->isRace)
                                <tr>
                                    <th>Price</th>
                                    <td>{{$event->price}}</td>
                                </tr>
                                @endif
                            @if($event->description)
                            <tr>
                                <th>Description</th>
                                <td>{{$event->description}}</td>
                            </tr>
                                @endif
                            @if($event->additional_information)
                                <tr>
                                    <th>Additional Information</th>
                                    <td>{{$event->additional_information}}</td>
                                </tr>
                            @endif
                            @if(!$event->isRace || $event->requirements)
                            <tr>
                                <th class="align-middle">Requirements</th>
                                @if(!$event->isRace)
                                <td>@if($event->helmet_required)
                                        <img src="{{asset('images/icons/requirements/helmet.png')}}" alt="Helmet" width="35px">
                                    @endif
                                    @if($event->lights_required)
                                        <img src="{{asset('images/icons/requirements/lights.png')}}" alt="Lights" width="35px" class="mx-2">
                                    @endif </td>
                                    @else
                                <td>{{$event->requirements}}</td>
                                @endif
                            </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection