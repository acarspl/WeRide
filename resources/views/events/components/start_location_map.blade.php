<div id="start_map_{{$iteration}}" style="height: {{$height}}px">

</div>
<script type="text/javascript">
     mapBoxToken = '{{config('services.mapbox.token')}}';
     iteration = '{{$iteration}}';
     lat = '{{$lat}}';
     lng = '{{$lng}}';
</script>
<script type="text/javascript" src="{{asset('js/showStartLocation.js')}}"></script>
