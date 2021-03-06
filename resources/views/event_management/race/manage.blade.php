@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/createEvent.css') }}" rel="stylesheet">
    @if($errors->any())
        <div class="alert alert-danger text-center mt-2" role="alert">
            {{$errors->first()}}
        </div>
    @endif
    <div class="container mt-5 row mx-auto">
        <div class="card col-12 col-lg-10 col-xl-9 mx-auto px-0">
            <div class="card-header mx-0 bg-green row justify-content-center ">
                <img  src="{{asset('images/logo/bike.png')}}" width="30" height="30" class="d-inline-block align-top mt-1" alt="">
                <h4 class="text-center text-white mt-2 mx-3">@isset($event) Edit @else Create a new @endisset race</h4>
            </div>
            <div class="card-body">
                <form id="event_form" action="@isset($event){{route('race.update',$event)}}@else{{route('race.store')}}@endisset" method="POST">
                    @csrf
                    @isset($event)
                        @method('PATCH')
                    @else
                        @method('post')
                    @endisset
                    {{--SPORT SELECTOR--}}
                    @isset($event)
                        @include('event_management.components.sport_selector',["sport_type_id"=>$event->sport_type_id])
                    @else
                        @include('event_management.components.sport_selector',["sport_type_id"=>false])
                    @endisset

                        <hr>
                        {{--END OF SPORT SELECTOR--}}
                        <div class="form-group text-center mx-auto">
                            <label for="name" class="formLabelBigger input-required">Event Name</label>
                            <textarea maxlength="200" minlength="4" class="form-control text-center" id="name" name="name" rows="1" required
                            >@isset($event){{$event->name}}@endisset</textarea>
                        </div>
                        <div class="form-group text-center mt-3">
                            <label for="start_time" class="formLabelBigger input-required">Start Time</label>
                            <input type="datetime-local" class="form-control text-center col-10 col-sm-6 mx-auto" id="start_time" name="start_time"
                                   @isset($event)
                                   value="{{substr(\Carbon\Carbon::parse($event->start_time)->toDateTimeLocalString(),0,16)}}"
                                   min="{{substr(\Carbon\Carbon::parse($event->start_time)->toDateTimeLocalString(),0,16)}}"
                                   @else
                                   value="{{substr(\Carbon\Carbon::now()->addHours(2)->toDateTimeLocalString(),0,16)}}"
                                   min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}"
                                   @endisset
                                   max="{{substr(\Carbon\Carbon::now()->addYear()->toDateTimeLocalString(),0,16)}}" required>
                        </div>
                        <div class="form-group text-center">
                            <label class="formLabelBigger input-required" >Start Location</label>
                            <div id="start_location_map" style="height: 400px"></div>
                            <input type="hidden" value="null" id="start_location_lat" name="start_location_lat">
                            <input type="hidden" value="null" id="start_location_lng" name="start_location_lng">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block" type="button" id="round_trip_button">Round Trip</button>
                        </div>
                        <div class="form-group d-none text-center" id="end_location">
                            <label class="formLabelBigger">Finish Location</label>
                            <div id="end_location_map" style="height: 400px"></div>
                            <input type="hidden" value="" id="end_location_lat" name="end_location_lat">
                            <input type="hidden" value="" id="end_location_lng" name="end_location_lng">
                        </div>
                            <div class="form-group text-center mt-3">
                                <label for="end_time" class="formLabelBigger">Race Ends At</label>
                                <input type="datetime-local" class="form-control text-center col-10 col-sm-6 mx-auto" id="end_time" name="end_time"
                                       @isset($event)
                                       value="{{substr(\Carbon\Carbon::parse($event->end_time)->addHours(2)->toDateTimeLocalString(),0,16)}}"
                                       min="{{substr(\Carbon\Carbon::now()->addHours(2)->toDateTimeLocalString(),0,16)}}"
                                       @else
                                       value="{{substr(\Carbon\Carbon::now()->addHours(2)->toDateTimeLocalString(),0,16)}}"
                                       min="{{substr(\Carbon\Carbon::now()->addHours(2)->toDateTimeLocalString(),0,16)}}"
                                       @endisset required>
                            </div>
                        <div class="form-group text-center">
                            <label for="route_link" class="formLabelBigger">Route - Link</label>
                            <input type="text" class="form-control col-10 col-md-8 mx-auto" id="route_link" name="route_link" placeholder="https://www.strava.com/routes/..."
                                   @isset($event) value="{{$event->route_link}}" @endisset>
                        </div>
                        <div class="form-group text-center">
                            <label for="distance" class="formLabelBigger input-required">Distance</label>
                            <div class="row mx-auto col-7 col-md-5">
                                <input type="number" min="1" max="2000" step="0.1" class="pl-5 form-control col-8 col-md-9 col-xl-10 text-center "
                                       @isset($event) value="{{$event->distance}}" @endisset id="distance" required>
                                <input type="hidden" min="1"  @isset($event) value="{{$event->distance}}" @endisset id="distance_final" name="distance">
                                <button class="btn btn-primary col-4 col-md-3 col-xl-2" type="button" id="distance_button">Km</button>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="elevation" class="formLabelBigger">Elevation</label>
                            <div class="row mx-auto col-7 col-md-5">
                                <input type="number" min="0" max="90000" step="1" class="pl-5 form-control col-8 col-md-9 col-xl-10 text-center"
                                       value="@isset($event){{$event->elevation}}@else{{0}}@endisset" id="elevation" required>
                                <input type="hidden" min="0" value="@isset($event){{$event->elevation}}@else{{0}}@endisset"  id="elevation_final" name="elevation" >
                                <button class="btn btn-primary col-4 col-md-3 col-xl-2" type="button" id="elevation_button">M</button>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="form-group  mx-auto  col-6">
                                <label for="max_users" class="formLabelBigger">Maximum Number Of Participants</label>
                                <input type="number" min="2" max="5000" step="1" value="@isset($event){{$event->max_users}}@else{{100}}@endisset" class="form-control text-center" id="max_users" name="max_users" required>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label for="signing_deadline" class="formLabelBigger input-required">Signing Deadline</label>
                            <input type="datetime-local" class="form-control text-center col-10 col-sm-6 mx-auto" id="signing_deadline" name="signing_deadline" required
                                   @isset($event)
                                   value="{{substr(\Carbon\Carbon::parse($event->signing_deadline)->toDateTimeLocalString(),0,16)}}"
                                   max="{{substr(\Carbon\Carbon::parse($event->start_time)->toDateTimeLocalString(),0,16)}}"
                                   min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}"
                                   @else
                                   max="{{substr(\Carbon\Carbon::now()->addHour()->toDateTimeLocalString(),0,16)}}"
                                   min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}"
                                @endisset>
                        </div>
                        <div class="form-group text-center">
                            <label for="description" class="formLabelBigger">Description</label>
                            <textarea maxlength="920" class="form-control" id="description" name="description"
                                      rows="3">@isset($event){{$event->description}}@endisset</textarea>
                        </div>

                            <div class="row text-center justify-content-center">
                                <div class="col-6">
                                    <label for="price" class="formLabelBigger">Signing Fee</label>
                                    <input type="number" min="0" step="0.01" class="form-control text-center col-12 mx-auto" id="price" name="price"
                                           value="@isset($event){{$event->price}}@else{{0}}@endisset" required>
                                </div>
                                <div class="col-6">
                                    <label for="currency" class="formLabelBigger">Currency</label>
                                    <input type="text" min="0" maxlength="3" class="form-control text-center col-12 mx-auto" id="currency" name="currency"
                                           value="@isset($event){{$event->currency}}@else{{''}}@endisset">
                                </div>


                            </div>
                            <div class="form-group text-center mt-4">
                                <label for="requirements" class="formLabelBigger">Requirements</label>
                                <textarea maxlength="276" class="form-control" id="requirements" name="requirements"
                                          rows="1">@isset($event){{$event->requirements}}@endisset</textarea>
                            </div>

                        <div class="form-group text-center">
                            <label for="additional_information" class="formLabelBigger">Additional Information</label>
                            <textarea maxlength="276" class="form-control" id="additional_information" name="additional_information"
                                      rows="1">@isset($event){{$event->additional_information}}@endisset</textarea>
                        </div>
                        <button class="btn btn-success btn-block mt-3" id="create_ride_button" onclick="verifyAndSubmit()"  type="button">@isset($event)Edit @else Submit @endisset</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
            {{--SET JS VARIABLES--}}
        let metricUnits = '1'==="{{\Illuminate\Support\Facades\Auth::user()->preferences->metric}}";
        let endLocationLat = null;
        let endLocationLng = null;
            @isset($event)
        let defaultLocationLat = "{{$event->start_location_lat}}";
        let defaultLocationLng = "{{$event->start_location_lng}}";
        endLocationLat = "{{$event->end_location_lat}}";
        endLocationLng = "{{$event->end_location_lng}}";
            @else
        let defaultLocationLat = "{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lat}}";
        let defaultLocationLng = "{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lng}}";
        @endisset
    </script>
    <script src="{{ asset('js/createEventMap.js') }}" ></script>
    <script src="{{ asset('js/createEventForm.js') }}" ></script>

@endsection
