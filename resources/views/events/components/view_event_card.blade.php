<div class="card mt-2 mx-auto text-center">
    <div class="card-header bg-green mx-0  text-white">
        <img class="mb-1" @if($event->isRace) src="{{asset('images/icons/map/race_flag.png')}}" alt="Race"  @else src="{{asset('images/logo/bike.png')}}" alt="Ride" @endif style="width: 20px" >
        <span class="font-weight-bold mx-2">{{$event->name}}</span> <span> {{\Carbon\Carbon::parse($event->start_time)->format('d-m-Y H:i')}}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                @include('events.components.start_location_map', ['lat'=>$event->start_location_lat,'lng'=>$event->start_location_lng,'iteration'=>$loop,'height'=>300])
            </div>
            <div class="col-6 my-auto">
                <table class="table table-sm ">
                    <tbody>
                    <tr>
                        <th>Sport</th>
                        <td>{{$event->typeOfSport->name}}</td>
                    </tr>
                    <tr>
                        <th>Start</th>
                        <td>{{\Carbon\Carbon::parse($event->start_time)->format('d-m-Y H:i')}}</td>
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
                    @endif
                    @if($event->isRace)
                        <th>Signing Fee</th>
                        <td>{{$event->price}}</td>
                    @else
                    <tr>
                        <th class="align-middle">Requirements</th>
                            <td>@if($event->helmet_required)
                                    <img src="{{asset('images/icons/requirements/helmet.png')}}" alt="Helmet" width="35px">
                                @endif
                                @if($event->lights_required)
                                    <img src="{{asset('images/icons/requirements/lights.png')}}" alt="Lights" width="35px">
                                @endif </td>
                        @endif
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a class="btn btn-success btn-block" @if($event->isRace) href="{{route('race.show',$event)}}" @else href="{{route('ride.show',$event)}}" @endif>Details</a>
                        </td>
                    </tr>


                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
