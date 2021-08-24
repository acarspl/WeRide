@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/createEvent.css') }}" rel="stylesheet">
    <div class="container mt-5 row mx-auto">
        <div class="card col-12 col-lg-10 col-xl-9 mx-auto px-0">
            <div class="card-body">
                <form action="{{route('ride.store')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{substr(\Carbon\Carbon::now()->addHour()->toDateTimeLocalString(),0,16)}}"
                               min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}" max="{{substr(\Carbon\Carbon::now()->addYear()->toDateTimeLocalString(),0,16)}}" required>
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
                            <img class="fadedImage"  id="road_cycling_image" style="width: 100%; border-top-left-radius:15px;  border-bottom-left-radius:15px" src="{{asset('images/types_of_bikes/road_cycling.jpg')}}" alt="Road Cycling">
                            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="road_cycling_text">Road Cycling</h4>
                            </div>
                            <div class="col-5 mx-0 mb-1 px-0 bg-black sport_type_box" id="mtb_box"  style="position: relative; border-top-right-radius:15px;  border-bottom-right-radius:15px">
                            <img class="fadedImage" id="mtb_image" style="width: 100%; border-top-right-radius:15px; border-bottom-right-radius:15px" src="{{asset('images/types_of_bikes/mtb.jpg')}}" alt="MTB">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="mtb_text">MTB</h4>
                            </div>
                        </div>
                        <div class="row mx-auto justify-content-center">
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="gravel_box"  style="position: relative;  border-top-left-radius:15px; border-bottom-left-radius:15px">
                                <img class="fadedImage" id="gravel_image" style="width: 100%;  border-top-left-radius:15px; border-bottom-left-radius:15px" src="{{asset('images/types_of_bikes/gravel_ride.jpg')}}" alt="Gravel">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="gravel_text">Gravel</h4>
                            </div>
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="bike_touring_box"  style="position: relative;">
                                <img class="fadedImage" id="bike_touring_image" style="width: 100%" src="{{asset('images/types_of_bikes/casual_ride_in_park.jpg')}}" alt="Bike Touring">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="bike_touring_text">Bike Touring</h4>
                            </div>
                            <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="enduro_box" style="position: relative;  border-top-right-radius:15px; border-bottom-right-radius:15px">
                                <img class="fadedImage" id="enduro_image" style="width: 100%;  border-top-right-radius:15px; border-bottom-right-radius:15px;" src="{{asset('images/types_of_bikes/enduro.jpg')}}" alt="Enduro">
                                <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="enduro_text">Enduro</h4>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="estimated_effort" class="form-label">Estimated Effort</label>
                            <input type="range" class="form-range form-control" min="1" max="5" step="1" value="3" id="estimated_effort" name="estimated_effort">
                        </div>
                        <div class="form-group">
                            <label for="route_link">Route - Link</label>
                            <input type="text" class="form-control" id="route_link" name="route_link" placeholder="https://www.strava.com/routes/...">
                        </div>
                        <div class="form-group">
                            <label for="distance">Distance</label>
                            <div class="row mx-auto">
                            <input type="number" min="1" max="2000" step="0.1" class="form-control col-10" id="distance" required>
                                <input type="hidden" min="1"  id="distance_final" name="distance">
                            <button class="btn btn-primary col-2" type="button" id="distance_button">Km</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="elevation">Elevation</label>
                            <div class="row mx-auto">
                                <input type="number" min="0" max="30000" step="1" value="0" class="form-control col-10" id="elevation" required>
                                <input type="hidden" min="0" value="0"  id="elevation_final" name="elevation">
                                <button class="btn btn-primary col-2" type="button" id="elevation_button">M</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="going_outside_website">People already going</label>
                                <input type="number" min="1" max="500" step="1" value="1" class="form-control" id="going_outside_website" name="going_outside_website" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="max_users">Maximum number of people</label>
                                <input type="number" min="2" max="2000" step="1" value="100" class="form-control" id="max_users" name="max_users" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="speed_min">Minimum Average Speed</label>
                                <div class="row mx-auto">
                                    <input type="number" min="4" max="55" step="0.1" class="form-control col-7 col-lg-10" id="speed_min" required>
                                    <input type="hidden" min="4"  id="speed_min_final" name="speed_min">
                                    <button class="btn btn-primary col-5 col-lg-2 speed_button" type="button">Kph</button>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="speed_max">Maximum Average Speed</label>
                                <div class="row  mx-auto">
                                    <input type="number" min="4" max="55" step="0.1" class="form-control col-7 col-lg-10" id="speed_max" required>
                                    <input type="hidden" min="4"  id="speed_max_final" name="speed_max">
                                    <button class="btn btn-primary col-5 col-lg-2 speed_button" type="button">Kph</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signing_deadline">Signing Deadline</label>
                            <input type="datetime-local" class="form-control" id="signing_deadline" name="signing_deadline" required
                            max="{{substr(\Carbon\Carbon::now()->addHour()->toDateTimeLocalString(),0,16)}}" min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea maxlength="920" class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="additional_information">Additional Information</label>
                            <textarea maxlength="276" class="form-control" id="additional_information" name="additional_information" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Requirements</label>
                            <input type="hidden" id="helmet_required" name="helmet_required" value="true">
                            <input type="hidden" id="lights_required" name="lights_required" value="false">
                            <div class="row mx-auto justify-content-center">
                                <div class="col-5 col-md-4 col-lg-3 mb-1 px-0 bg-black requirements_box" id="helmet_box" style="position: relative; border-top-left-radius:15px;  border-bottom-left-radius:15px">
                                    <img id="helmet_image" style="width: 100%; border-top-left-radius:15px;  border-bottom-left-radius:15px" src="{{asset('images/equipment/helmet.jpg')}}" alt="Helmet">
                                    <h4 class="overlayTextRequirement py-1 mb-0 text-white text-center col-12 bg-black-semi-transparent" id="helmet_text" style="border-bottom-left-radius:15px">Helmet</h4>
                                </div>
                                <div class="col-5 col-md-4 col-lg-3 mx-0 mb-1 px-0 bg-black requirements_box" id="lights_box"  style="position: relative; border-top-right-radius:15px;  border-bottom-right-radius:15px">
                                    <img class="strongerFadedImage" id="lights_image" style="width: 100%; border-top-right-radius:15px; border-bottom-right-radius:15px" src="{{asset('images/equipment/lights.jpg')}}" alt="Lights">
                                    <h4 class="overlayTextRequirement py-1 mb-0 text-white text-center col-12 fadedText" id="lights_text" style="border-bottom-right-radius:15px">Lights</h4>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-block mt-3" type="button">Create</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--ADD MAPBOX TOKEN FORM ENV FILE--}}
    <script type="text/javascript">
        let mapBoxToken = "{{config('services.mapbox.token')}}";
        let metricUnits = true;
    </script>
    <script src="{{ asset('js/createEventMap.js') }}" ></script>
    <script src="{{ asset('js/createEventForm.js') }}" ></script>

@endsection
