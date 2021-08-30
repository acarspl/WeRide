@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-green text-center text-white">
                <h4 class="pt-2">Preferences</h4>
            </div>
            <div class="card-body">
                <form action="{{route('user.preferences.update')}}" method="POST" class="text-center">
                    @csrf @method('PATCH')
                    <h5> Favorite Sports </h5>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="road_cycling" name="road_cycling" @if($preferences->road_cycling) checked @endif>
                        <label class="form-check-label" for="road_cycling">
                            Road Cycling
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="gravel" name="gravel" @if($preferences->gravel) checked @endif>
                        <label class="form-check-label" for="gravel">
                            Gravel
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="bike_touring" name="bike_touring" @if($preferences->bike_touring) checked @endif>
                        <label class="form-check-label" for="bike_touring">
                            Bike Touring
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="mtb" name="mtb" @if($preferences->mtb) checked @endif>
                        <label class="form-check-label" for="mtb">
                            MTB
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="enduro" name="enduro" @if($preferences->enduro) checked @endif>
                        <label class="form-check-label" for="enduro">
                            Enduro
                        </label>
                    </div>
                    <hr>
                    <h5>Settings</h5>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" id="metric" name="metric" @if($preferences->metric) checked @endif>
                        <label class="form-check-label" for="metric">
                            Use metric system
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <label class="font-weight-bold mt-2" style="font-size: 120%" >Default Location</label>
                        <div id="start_location_map" style="height: 400px"></div>
                        <input type="hidden" value="null" id="start_location_lat" name="start_location_lat">
                        <input type="hidden" value="null" id="start_location_lng" name="start_location_lng">
                    </div>
                    <button class="btn-green btn btn-block mt-3" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
    {{--ADD MAPBOX TOKEN FORM ENV FILE--}}
    <script type="text/javascript">
        let mapBoxToken = "{{config('services.mapbox.token')}}";
        let defaultLocationLat = "{{$preferences->location_lat}}";
        let defaultLocationLng = "{{$preferences->location_lng}}";
    </script>
    <script src="{{ asset('js/createEventMap.js') }}" ></script>
@endsection
