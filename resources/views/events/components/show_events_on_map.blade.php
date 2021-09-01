<div id="eventMap" style="height: 600px">
</div>
@include('events.components.filter_events')
<script type="text/javascript">
    mapBoxToken = '{{config('services.mapbox.token')}}';
    metricUnits = '{{Auth::user()->preferences->metric}}';
    defaultLocationLat = '{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lat}}';
    defaultLocationLng = '{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lng}}';
    </script>
<script type="text/javascript" src="{{asset('js/showEventsOnMap.js')}}"></script>
