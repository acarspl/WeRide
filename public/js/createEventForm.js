// DISTANCE METRIC/IMPERIAL
let distanceMetric = metricUnits;
if(!distanceMetric){
    changeDistanceToImperial();
}
$('#distance_button').on('click',function(){
    if(distanceMetric){
        changeDistanceToImperial();
    }
    else{
        changeDistanceToMetric();
    }
});
function changeDistanceToMetric(){
    $('#distance_button').addClass('btn-primary').removeClass('btn-outline-primary').text('Km');
    distanceMetric = true;
    $('#distance').val(milesToKilometers($('#distance').val()));
}
function changeDistanceToImperial(){
    $('#distance_button').addClass('btn-outline-primary').removeClass('btn-primary').text('mi');
    distanceMetric = false;
    $('#distance').val(kilometersToMiles($('#distance').val()));
}

$('#distance').change(function () {
    setDistanceFinal();
});
function  kilometersToMiles(km){
    return Math.round((km/1.609) * 10) / 10;
}
function milesToKilometers(mi){
    return Math.round((mi*1.609) * 10) / 10;
}
function setDistanceFinal(){
    $('#distance_final').val(convertDistanceToMetrics($('#distance').val()));
}
function convertDistanceToMetrics(distance){
    if(distanceMetric){
        return distance;
    }
    else{
        return  milesToKilometers(distance);
    }
}

// ELEVATION METRIC/IMPERIAL
let elevationMetric = metricUnits;
if(!elevationMetric){
    changeElevationToImperial();
}
$('#elevation_button').on('click',function(){
    if(elevationMetric){
        changeElevationToImperial();
    }
    else{
        changeElevationToMetric();
    }
});
function changeElevationToMetric(){
    $('#elevation_button').addClass('btn-primary').removeClass('btn-outline-primary').text('M');
    elevationMetric = true;
    $('#elevation').val(feetToMeters($('#elevation').val()));
}
function changeElevationToImperial(){
    $('#elevation_button').addClass('btn-outline-primary').removeClass('btn-primary').text('ft');
    elevationMetric = false;
    $('#elevation').val(metersToFeet($('#elevation').val()));
}
$('#elevation').change(function () {
    setElevationFinal();
});
function  metersToFeet(m){
   return Math.round(m*3.281);
}
function feetToMeters(ft){
    return Math.round(ft/3.281);
}
function setElevationFinal(){
    $('#elevation_final').val(convertElevationToMetrics($('#elevation').val()));
}
function convertElevationToMetrics(elevation){
    if(elevationMetric){
        return elevation;
    }
    else{
        return  feetToMeters(elevation);
    }
}

// Min Average Speed
let metricAverageSpeed = metricUnits;
if(!metricAverageSpeed){
    changeSpeedToImperial();
}
$('.speed_button').on('click',function(){
    if(metricAverageSpeed){
      changeSpeedToImperial();
    }
    else{
        changeSpeedToMetric();
    }
});
function changeSpeedToImperial(){
    $('.speed_button').addClass('btn-outline-primary').removeClass('btn-primary').text('mph');
    metricAverageSpeed = false;
    $('#speed_min').val(kilometersToMiles($('#speed_min').val()));
    $('#speed_max').val(kilometersToMiles($('#speed_max').val()));
    $('#speed_max').attr('min',$('#speed_min').val());
    $('#speed_min').attr('max',$('#speed_max').val());
}
function changeSpeedToMetric(){
    $('.speed_button').addClass('btn-primary').removeClass('btn-outline-primary').text('Kph');
    metricAverageSpeed = true;
    $('#speed_min').val(milesToKilometers($('#speed_min').val()));
    $('#speed_max').val(milesToKilometers($('#speed_max').val()));
    $('#speed_max').attr('min',$('#speed_min').val());
    $('#speed_min').attr('max',$('#speed_max').val());
}
$('#speed_min').change(function () {
    setMinSpeedFinal();
});
function setMinSpeedFinal(){
    $('#speed_min_final').val(convertSpeedToMetrics($('#speed_min').val()));
    $('#speed_max').attr('min',$('#speed_min').val());
}
function convertSpeedToMetrics(speed){
    if(metricAverageSpeed){
        return speed;
    }
    else{
        return  milesToKilometers(speed);
    }
}
// Max Average Speed
$('#speed_max').change(function () {
    setMaxSpeedFinal();
});
function setMaxSpeedFinal(){
    $('#speed_max_final').val(convertSpeedToMetrics($('#speed_max').val()));
    $('#speed_min').attr('max',$('#speed_max').val());
}

// set signing deadline value and max
let startTime = null;
$('#start_time').change(function () {
    startTime = new Date($('#start_time').val());
    $('#signing_deadline').val(changeDateToDateTimeLocale(startTime)).attr('max',changeDateToDateTimeLocale(startTime));
    $('#end_time').val(changeDateToDateTimeLocale(startTime)).attr('min',changeDateToDateTimeLocale(startTime));
});
function changeDateToDateTimeLocale(date){
    let isoStr = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString();
    return isoStr.substring(0,isoStr.length-1);
}
//REQUIREMENTS SELECTOR
$("#helmet_box").on('click',function (e) {
    if($('#helmet_required').val()===1){
        $('#helmet_required').val(0);
    }
    else{
        $('#helmet_required').val(1);
    }
    $("#helmet_image").toggleClass('strongerFadedImage');
    $("#helmet_text").toggleClass('fadedText').toggleClass('bg-black-semi-transparent');
});
$("#lights_box").on('click',function (e) {
    if($('#lights_required').val()===1){
        $('#lights_required').val(0);
    }
    else{
        $('#lights_required').val(1);
    }
    $("#lights_image").toggleClass('strongerFadedImage');
    $("#lights_text").toggleClass('fadedText').toggleClass('bg-black-semi-transparent');
});



// submit
function verifyAndSubmit(){
    // validate if type of sport is selceted
    if($("#sport_type_id").val()==0){
        $('#select_sport_alert').removeClass('d-none');
        document.getElementById("select_sport_alert").scrollIntoView();
        return false;
    }
    $('#event_form').submit();
}
