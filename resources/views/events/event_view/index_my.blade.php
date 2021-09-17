@extends('layouts.app')

@section('content')
    <div class="container col-12 col-sm-11 col-md-8 col-xl-6">
        @if($events_joined->count()>0)
        <div class="card mx-auto mt-5 text-center">
            <div class="card-header bg-green mx-0 text-white">Joined Events</div>
            <div class="card-body py-1 bg-gray">
                @foreach($events_joined as $event)
                    @include('events.components.view_event_card',['event'=>$event, 'loop'=>'j'.$loop->iteration])
                @endforeach
            </div>
        </div>
        @endif
        <div class="card mx-auto mt-5 text-center">
            <div class="card-header bg-green mx-0 text-white">Created Events</div>
            <div class="card-body py-1 bg-gray">
                @if($events->count()===0)
                    <div class="mt-2">
                        You don't have any active events. Feel free to create one!
                    </div>
                    <a href="{{route('ride.create')}}" class="btn btn-green mx-auto mt-2">Create Ride</a>
                    @endif
                @foreach($events as $event)
                    @include('events.components.view_event_card',['event'=>$event, 'loop'=>$loop->iteration])
                    @endforeach
            </div>
        </div>
    </div>




    @endsection
