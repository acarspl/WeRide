<div class="alert alert-danger text-center d-none" id="select_sport_alert" role="alert">
    Select Sport
</div>
{{--SPORT SELECTOR--}}
<div>
    <input type="hidden" name="sport_type_id" id="sport_type_id" value=0>
    <div class="row mx-auto justify-content-center">
        <div class="col-5 mb-1 px-0 bg-black sport_type_box round-top-left round-bottom-left" id="road_cycling_box" style="position: relative;">
            <img class="fadedImage round-top-left round-bottom-left"  id="road_cycling_image" style="width: 100%;" src="{{asset('images/types_of_bikes/road_cycling.jpg')}}" alt="Road Cycling">
            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="road_cycling_text">Road Cycling</h4>
        </div>
        <div class="col-5 mx-0 mb-1 px-0 bg-black sport_type_box round-top-right round-bottom-right" id="mtb_box"  style="position: relative;">
            <img class="fadedImage round-top-right round-bottom-right" id="mtb_image" style="width: 100%;" src="{{asset('images/types_of_bikes/mtb.jpg')}}" alt="MTB">
            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="mtb_text">MTB</h4>
        </div>
    </div>
    <div class="row mx-auto justify-content-center">
        <div class="col-4 mx-0 px-0 bg-black sport_type_box round-top-left round-bottom-left" id="gravel_box"  style="position: relative;">
            <img class="fadedImage round-top-left round-bottom-left" id="gravel_image" style="width: 100%;" src="{{asset('images/types_of_bikes/gravel_ride.jpg')}}" alt="Gravel">
            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="gravel_text">Gravel</h4>
        </div>
        <div class="col-4 mx-0 px-0 bg-black sport_type_box" id="bike_touring_box"  style="position: relative;">
            <img class="fadedImage" id="bike_touring_image" style="width: 100%" src="{{asset('images/types_of_bikes/casual_ride_in_park.jpg')}}" alt="Bike Touring">
            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="bike_touring_text">Bike Touring</h4>
        </div>
        <div class="col-4 mx-0 px-0 bg-black sport_type_box round-top-right round-bottom-right" id="enduro_box" style="position: relative;">
            <img class="fadedImage round-top-right round-bottom-right" id="enduro_image" style="width: 100%; " src="{{asset('images/types_of_bikes/enduro.jpg')}}" alt="Enduro">
            <h4 class="overlayTextCenter py-2 text-white text-center col-12 fadedText" id="enduro_text">Enduro</h4>
        </div>
    </div>
</div>
<script type="text/javascript">
        @isset($event)
    let sportSelector = "{{$sport_type_id}}";
        @else
    let sportSelector = false;
    @endisset
</script>
<script src="{{ asset('js/sportSelector.js') }}" ></script>
