@extends('layouts.app')

@section('content')
    <div class="container col-12 col-sm-11 col-md-8 col-xl-6">
        <div class="card mx-auto mt-5 text-center">
            <div class="card-header bg-green mx-0 text-white">Event List</div>
            <div class="card-body py-1" style="background-color: #e7e7e7">
                @foreach($events as $event)
                    @include('events.components.view_event_card',['event'=>$event, 'loop'=>$loop->iteration])
                @endforeach
            </div>
        </div>
    </div>




@endsection
