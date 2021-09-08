@extends('layouts.app')

@section('content')
    @auth
    <div class="row justify-content-center">
        <a class="btn btn-block btn-lg text-center mx-auto btn-green-light py-3" href="{{route('race.create')}}">Create a new race</a>
    </div>
    @endauth
    @include('events.components.show_events_on_map',['onlyRaces'=>true])
    <div class="container col-12 col-sm-11 col-md-8 col-xl-6">
        <div class="card mx-auto mt-5 text-center">
            <div class="card-header bg-green mx-0 text-white">Races</div>
            <div class="card-body py-1" id="events_card_body" style="background-color: #e7e7e7">
            </div>
        </div>
    </div>
    <script src="{{asset('js/showEventsInCard.js')}}"></script>

@endsection
