<div class="card">
    <div class="card-header bg-green text-center text-white">
        Filters
    </div>
    <form id="filterForm">
    <div class="card-body my-1 py-0">
        <div class=" my-0 ">
            <div class="row">
                <div class="col-4 col-lg-2 text-center font-weight-bold pt-1">Event Type</div>
                <div class="col-8 col-lg-4">
                    <select class="filterInput custom-select" id="is_race">
                        <option value="0" selected>Rides & Races</option>
                        <option value="1">Rides Only</option>
                        <option value="2">Races Only</option>
                    </select>
                </div>
                <div  class="col-4 col-lg-2 mt-1 mt-lg-0 text-center font-weight-bold pt-1">Sport</div>
                <div class="col-8 col-lg-4 mt-1 mt-lg-0" >
                    <select class="filterInput custom-select " id="sport_type">
                        <option value="0" selected>All Sports</option>
                        <option value="1">Road Cycling</option>
                        <option value="2">Gravel Riding</option>
                        <option value="3">Bike Touring</option>
                        <option value="4">Mountain Biking (MTB)</option>
                        <option value="5">Enduro Biking</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div  class="col-4 col-lg-2 mt-1 mt-lg-0 text-center font-weight-bold pt-1">Start Time</div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="datetime-local" class="filterInput form-control  text-center" id="start_time_from" name="start_time_from" value="{{substr(\Carbon\Carbon::now()->addHours(2)->toDateTimeLocalString(),0,16)}}"
                           min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}" max="{{substr(\Carbon\Carbon::now()->addYear()->toDateTimeLocalString(),0,16)}}" ></div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="datetime-local" class="filterInput form-control   text-center" id="start_time_to" name="start_time_to"
                           min="{{substr(\Carbon\Carbon::now()->toDateTimeLocalString(),0,16)}}" max="{{substr(\Carbon\Carbon::now()->addYear()->toDateTimeLocalString(),0,16)}}" ></div>
                <div  class="col-4 col-lg-2 mt-1 mt-lg-0 text-center font-weight-bold pt-1">Speed @if(\Illuminate\Support\Facades\Auth::user()->preferences->metric)(kph) @else (mph) @endif</div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="number" min="0" max="55" step="0.1" class="filterInput form-control  text-center" id="speed_from"></div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="number" min="0" max="55" step="0.1" class="filterInput  form-control text-center" id="speed_to"></div>
            </div>
            <div class="row">
                <div  class="col-4 col-lg-2 mt-1 mt-lg-0 text-center font-weight-bold pt-1">Distance @if(\Illuminate\Support\Facades\Auth::user()->preferences->metric)(km) @else (mi) @endif</div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="number" min="0" max="2000" step="0.1" class="filterInput  form-control text-center " id="distance_from"></div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"> <input type="number" min="0" max="2000" step="0.1" class="filterInput  form-control text-center " id="distance_to"></div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0 text-center font-weight-bold pt-1">Elevation @if(\Illuminate\Support\Facades\Auth::user()->preferences->metric)(m) @else (ft) @endif </div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="number" min="0" max="90000" step="1"  class="filterInput  form-control  text-center" id="elevation_from"></div>
                <div class="col-4 col-lg-2 mt-1 mt-lg-0"><input type="number" min="0" max="90000" step="1"  class="filterInput  form-control  text-center" id="elevation_to"></div>
            </div>
        </div>
    </div>
    </form>
</div>
