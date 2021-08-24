// SPORT SELECTOR
$(".sport_type_box").on('click',function (e) {
    $('.sport_type_box').find('img').addClass('fadedImage');
    $('.sport_type_box').find('h4').addClass('fadedText').removeClass('bg-green');
    $('#'+this.children[0].id).removeClass('fadedImage');
    $('#'+this.children[1].id).removeClass('fadedText').addClass('bg-green');
    switch(this.id){
        case 'road_cycling_box':
            $("#sport_type_id").val(1);
            break;
        case "mtb_box":
            $("#sport_type_id").val(4);
            break;
        case "gravel_box":
            $("#sport_type_id").val(2);
            break;
        case "bike_touring_box":
            $("#sport_type_id").val(3);
            break;
        case "enduro_box":
            $("#sport_type_id").val(5);
            break;

        default:
                console.log("Error, no type selected!");
    }
});

// DISTANCE METRIC/IMPERIAL
let distanceMetric = metricUnits;
$('#distance_button').on('click',function(){
    if(distanceMetric){
        $('#distance_button').addClass('btn-outline-primary').removeClass('btn-primary').text('mi');
        distanceMetric = false;
        $('#distance').val(kilometersToMiles($('#distance').val()));
    }
    else{
        $('#distance_button').addClass('btn-primary').removeClass('btn-outline-primary').text('Km');
        distanceMetric = true;
        $('#distance').val(milesToKilometers($('#distance').val()));
    }
});
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
$('#elevation_button').on('click',function(){
    if(elevationMetric){
        $('#elevation_button').addClass('btn-outline-primary').removeClass('btn-primary').text('ft');
        elevationMetric = false;
        $('#elevation').val(metersToFeet($('#elevation').val()));
    }
    else{
        $('#elevation_button').addClass('btn-primary').removeClass('btn-outline-primary').text('M');
        elevationMetric = true;
        $('#elevation').val(feetToMeters($('#elevation').val()));
    }
});
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
$('.speed_button').on('click',function(){
    if(metricAverageSpeed){
        $('.speed_button').addClass('btn-outline-primary').removeClass('btn-primary').text('mph');
        metricAverageSpeed = false;
        $('#speed_min').val(kilometersToMiles($('#speed_min').val()));
        $('#speed_max').val(kilometersToMiles($('#speed_max').val()));
    }
    else{
        $('.speed_button').addClass('btn-primary').removeClass('btn-outline-primary').text('Kph');
        metricAverageSpeed = true;
        $('#speed_min').val(milesToKilometers($('#speed_min').val()));
        $('#speed_max').val(milesToKilometers($('#speed_max').val()));
    }
});
$('#speed_min').change(function () {
    setMinSpeedFinal();
});
function setMinSpeedFinal(){
    $('#speed_min_final').val(convertSpeedToMetrics($('#speed_min').val()));
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
}

// set signing deadline value and max
let startTime = null;
$('#start_time').change(function () {
    startTime = new Date($('#start_time').val());
    $('#signing_deadline').val(changeDateToDateTimeLocale(startTime)).attr('max',changeDateToDateTimeLocale(startTime));
});
function changeDateToDateTimeLocale(date){
    let isoStr = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString();
    return isoStr.substring(0,isoStr.length-1);
}
//REQUIREMENTS SELECTOR
$("#helmet_box").on('click',function (e) {
    if(Boolean($('#helmet_required').val())===true){
        $('#helmet_required').val(false);
    }
    else{
        $('#helmet_required').val(true);
    }
    $("#helmet_image").toggleClass('strongerFadedImage');
    $("#helmet_text").toggleClass('fadedText').toggleClass('bg-black-semi-transparent');
});
$("#lights_box").on('click',function (e) {
    if(Boolean($('#lights_required').val())===true){
        $('#lights_required').val(false);
    }
    else{
        $('#lights_required').val(true);
    }
    $("#lights_image").toggleClass('strongerFadedImage');
    $("#lights_text").toggleClass('fadedText').toggleClass('bg-black-semi-transparent');
});
