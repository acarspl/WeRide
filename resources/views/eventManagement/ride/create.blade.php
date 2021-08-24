@extends('layouts.app')
<link href="{{ asset('css/createEvent.css') }}" rel="stylesheet">
@section('content')

    <div class="mt-5 row">
        <div class="card col-12 col-lg-6 col-xl-5 mx-auto">
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
                    <div class="form-group">
                        <button class="btn btn-success btn-block" type="button" id="round_trip_button">Round Trip</button>
                    </div>
                    <div class="form-group d-none" id="end_location">
                        <label >Finish Location</label>
                        <div id="end_location_map" style="height: 400px"></div>
                        <input type="hidden" value="null" id="end_location_lat" name="end_location_lat">
                        <input type="hidden" value="null" id="end_location_lng" name="end_location_lng">
                    </div>
                    <div>
                        <label>Sport</label>
                        <input type="hidden" name="sport_type_id" id="sport_type_id" value=0>
                        <div class="row mx-auto justify-content-center">
                            <div class="col-5 mb-1 px-0 bg-black sport_type_box" id="road_cycling_box" style="position: relative; border-top-left-radius:15px;  border-bottom-left-radius:15px">
                            <img class="typeOfSportImage"  id="road_cycling_image" style="width: 100%; border-top-left-radius:15px;  border-bottom-left-radius:15px" src="{{asset('images/types_of_bikes/road_cycling.jpg')}}" alt="Road Cycling">
                            <h4 class="overlayTextCenter py-2 text-white text-center col-12 typeOfSportText" id="road_cycling_text">Road Cycling</h4>
                            </div>
                            <div class="col-5 mx-0 mb-1 px-0 bg-black sport_type_box" id="mtb_box"  style="position: relative; border-top-right-radius:15px;  border-bottom-right-radius:15px">
                            <img class="typeOfSportImage" id="mtb_image" style="width: 100%; border-top-right-radius:15px; border-bottom-right-radius:15px" src="{{asset('images/types_of_bikes/mtb.jpg')}}" alt="MTB">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 typeOfSportText" id="mtb_text">MTB</h4>
                            </div>
                        </div>
                        <div class="row mx-auto justify-content-center">
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="gravel_box"  style="position: relative;  border-top-left-radius:15px; border-bottom-left-radius:15px">
                                <img class="typeOfSportImage" id="gravel_image" style="width: 100%;  border-top-left-radius:15px; border-bottom-left-radius:15px" src="{{asset('images/types_of_bikes/gravel_ride.jpg')}}" alt="Gravel">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 typeOfSportText" id="gravel_text">Gravel</h4>
                            </div>
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="bike_touring_box"  style="position: relative;">
                                <img class="typeOfSportImage" id="bike_touring_image" style="width: 100%" src="{{asset('images/types_of_bikes/casual_ride_in_park.jpg')}}" alt="Bike Touring">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 typeOfSportText" id="bike_touring_text">Bike Touring</h4>
                            </div>
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="enduro_box" style="position: relative;  border-top-right-radius:15px; border-bottom-right-radius:15px">
                                <img class="typeOfSportImage" id="enduro_image" style="width: 100%;  border-top-right-radius:15px; border-bottom-right-radius:15px;" src="{{asset('images/types_of_bikes/enduro.jpg')}}" alt="Enduro">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 typeOfSportText" id="enduro_text">Enduro</h4>
                            </div>
                        </div>



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
    <script src="{{ asset('js/createEventForm.js') }}" ></script>

@endsection
