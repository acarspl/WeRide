<div id="eventMap" style="height: 600px">
</div>
@include('events.components.filter_events')
<script type="text/javascript">
    metricUnits = @auth'{{Auth::user()->preferences->metric}}' @else '1' @endauth;
    defaultLocationLat = @auth'{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lat}}'@else '51.505' @endauth ;
    defaultLocationLng = @auth'{{\Illuminate\Support\Facades\Auth::user()->preferences->location_lng}}'@else '-0.09' @endauth;
    let onlyRaces = '{{$onlyRaces}}';
    </script>
<script type="text/javascript" src="{{asset('js/showEventsOnMap.js')}}"></script>
