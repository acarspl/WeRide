var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 600000000,
};

function success(pos) {
    updatePosition(pos.coords);
    $.cookie('location_check', '1',{expires: 7});
}

function error(err) {
    console.log('Geolocation not given');
}
if(!$.cookie('location_check'))
navigator.geolocation.getCurrentPosition(success, error, options);


function updatePosition(crd){
    $.ajax({
        type: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/user/preferences/location",
        data: {
            "start_location_lat": crd.latitude,
            "start_location_lng": crd.longitude,
        },
        success: function(){
        },
        error: function () {
        }
    });
}

