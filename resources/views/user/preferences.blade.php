@extends('layouts.app')
{{--FILE INPUT DEPENDENCIES--}}
<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.3/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- the jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.3/js/fileinput.min.js"></script>



@section('content')
    <div class="container mt-2 mt-lg-5">
        @if($errors->any())
            <div class="alert alert-danger text-center mt-2" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-green text-center text-white">
                <h4 class="pt-2">Preferences</h4>
            </div>
            <div class="card-body">
                <form action="{{route('user.preferences.update')}}" method="POST" class="text-center" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <h5>Avatar</h5>
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('avatars/'.\Illuminate\Support\Facades\Auth::id().'.jpg'))
                    <img src="{{\Illuminate\Support\Facades\Storage::url('avatars/'.\Illuminate\Support\Facades\Auth::id().'.jpg')}}" style="width: 64px" alt="Avatar">
                    @endif
                    <div class="col-12 col-md-8 col-lg-6 mx-auto mt-3">
                        <input id="avatar" name="avatar" type="file" class="file" data-show-preview="false" accept=".jpg,.jpeg">
                        <small>.jpg square files (min: 32x32 max:256x256)</small>
                    </div>
                    <hr>
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
                        <div class="col-12 col-lg-8 mx-auto" id="start_location_map" style="height: 400px"></div>
                        <input type="hidden"  id="start_location_lat" name="start_location_lat">
                        <input type="hidden"  id="start_location_lng" name="start_location_lng">
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
