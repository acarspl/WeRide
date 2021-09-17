@extends('layouts.app')

@section('content')
    @php
    $iteration = 0;
    @endphp
    <div class="col-12 mt-3 container row mx-auto justify-content-center">
        {{--UPCOMING RACES IN THE USER'S AREA--}}
        <div class="d-none d-xl-block col-3">
            <div class="card px-0">
                <h5 class="card-header text-center bg-green text-white font-weight-bold">
                    Upcoming races in your area
                </h5>
                <div class="card-body pt-0 mx-1 px-1">
                    @foreach($nearbyRaces as $event)
                        @include('events.components.view_event_card',['event'=>$event, 'loop'=>'j'.$iteration++])
                    @endforeach
                </div>
            </div>
        </div>
        {{--OUR RECOMENDATIONS--}}
        <div class="col-12 col-lg-6 col-xl-5">
            <div class="card px-0">
                <h5 class="card-header text-center bg-green text-white font-weight-bold">
                    Consider participation
                </h5>
                <div class="card-body pt-0 mx-1 px-1">
                    @if($recommendedEvents->count()===0)
                        <div class="text-center mt-3">Currently we cannot recommend you any events</div>
                    @endif
                    @foreach($recommendedEvents as $event)
                        @include('events.components.view_event_card',['event'=>$event, 'loop'=>'j'.$iteration++])
                    @endforeach
                </div>
            </div>
        </div>
        {{--UPCOMING EVENTS USER SIGNED UP FOR--}}
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card px-0">
                <h5 class="card-header text-center bg-green text-white font-weight-bold">
                    Events you've signed up for
                </h5>
                <div class="card-body pt-0 mx-1 px-1">
                    @if($joinedEvents->count()===0)
                       <div class="text-center">No events found</div>
                        @endif
                    @foreach($joinedEvents as $event)
                            @include('events.components.view_event_card',['event'=>$event, 'loop'=>'j'.$iteration++])
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
