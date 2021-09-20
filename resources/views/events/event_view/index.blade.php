@extends('layouts.app')

@section('content')
    @include('events.components.show_events_on_map',['onlyRaces'=>false])
    <div class="container col-12 col-sm-11 col-md-8 col-xl-6">
        <a href="{{route('users.index')}}" class="btn btn-primary btn-block mt-2">&#128270; Find Users</a>
        <div class="card mx-auto mt-3 text-center">
            <div class="card-header bg-green mx-0 text-white">Event List</div>
            <div class="card-body py-1 bg-gray" id="events_card_body">
            </div>
        </div>
    </div>

<script src="{{asset('js/showEventsInCard.js')}}"></script>


@endsection
