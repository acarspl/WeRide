@extends('layouts.app')

@section('content')
    <div class="mt-5 row">
        <div class="card col-4 mx-auto">
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="startTime">Start Time</label>
                        <input type="datetime-local" class="form-control" id="startTime" name="start_time" value="{{substr(\Carbon\Carbon::now()->addHour()->toDateTimeLocalString(),0,16)}}"
                               min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}" max="{{substr(\Carbon\Carbon::now()->addYear()->toDateTimeLocalString(),0,16)}}">
                    </div>
                    <div class="form-group">
                        <label >Start Location</label>
                        <div id="start_location_map" style="height: 400px"></div>
                        <input type="hidden" value="null" id="start_location_lat" name="start_location_lat">
                        <input type="hidden" value="null" id="start_location_lng" name="start_location_lng">
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{--ADD MAPBOX TOKEN FORM ENV FILE--}}
    <script type="text/javascript">
        let mapBoxToken = "{{config('services.mapbox.token')}}";
    </script>
    <script src="{{ asset('js/createEventMap.js') }}" ></script>

@endsection
