@extends('layouts.app')

@section('content')
    @include('events.components.show_events_on_map')
    <div class="container col-12 col-sm-11 col-md-8 col-xl-6">
        <div class="card mx-auto mt-5 text-center">
            <div class="card-header bg-green mx-0 text-white">Event List</div>
            <div class="card-body py-1" id="events_card_body" style="background-color: #e7e7e7">
            </div>
        </div>
    </div>

<script src="{{asset('js/showEventsInCard.js')}}"></script>


@endsection
