<div id="eventMap" style="height: 600px">
</div>
<script type="text/javascript">
    mapBoxToken = '{{config('services.mapbox.token')}}';
    lat = '{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lat}}';
    lng = '{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lng}}';
    </script>
<script type="text/javascript" src="{{asset('js/showEventsOnMap.js')}}"></script>
