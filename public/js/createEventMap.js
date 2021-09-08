let startIcon = L.icon({
   iconUrl: "/images/icons/map/flag_start.png",
    iconSize: [40,40],
    iconAnchor: [10,40],
});
let endIcon = L.icon({
    iconUrl: "/images/icons/map/flag_finish.png",
    iconSize: [40,40],
    iconAnchor: [5,40],
});
let startMarker = null;
let endMarker = null;
let isRoundTrip = true;

var startMap = L.map('start_location_map').setView([defaultLocationLat, defaultLocationLng], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 17,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: mapBoxToken,
}).addTo(startMap);

if(defaultLocationLat !== '' && defaultLocationLng !==''){
    startMarker = L.marker([defaultLocationLat, defaultLocationLng],{
        icon: startIcon,
        draggable: true,
    }).addTo(startMap);
    updateField("start",{lat: defaultLocationLat, lng: defaultLocationLng});
    startMarker.on('dragend', function (e){
        updateField("start",e.target.getLatLng());
    });
}
startMap.on('click',function(e){
    if(!startMarker){
        startMarker = L.marker(e.latlng,{
            icon: startIcon,
            draggable: true,
        }).addTo(startMap);
        updateField("start",e.latlng);
        startMarker.on('dragend', function (e){
            updateField("start",e.target.getLatLng());
        });
    }
    else{
        startMarker.setLatLng(e.latlng);
        updateField("start",e.latlng);
    }
});

function updateField(field, coordinates){
    $('#'+field+'_location_lat').val(coordinates.lat);
    $('#'+field+'_location_lng').val(coordinates.lng);
}

// END MAP
if(document.getElementById('end_location_map')!== null){
    if(endLocationLat !== null && endLocationLng !==null){
        var endMap = L.map('end_location_map').setView([endLocationLat, endLocationLng], 13);
    }
    else{
        var endMap = L.map('end_location_map').setView([defaultLocationLat, defaultLocationLng], 13);
    }
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 17,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: mapBoxToken,
    }).addTo(endMap);
    endMap.on('click',function(e){
        if(!endMarker){
            endMarker = L.marker(e.latlng,{
                icon: endIcon,
                draggable: true,
            }).addTo(endMap);
            updateField("end",e.latlng);
            endMarker.on('dragend', function (e){
                updateField("end",e.target.getLatLng());
            });
        }
        else{
            endMarker.setLatLng(e.latlng);
            updateField("end",e.latlng);
        }
    });
    if(defaultLocationLat !== '' && defaultLocationLng !=='' && endLocationLat  !== null && endLocationLng!== null){
        if(defaultLocationLat != endLocationLat && defaultLocationLng != endLocationLng){
            $("#round_trip_button").removeClass('btn-success').addClass('btn-outline-success').text("One Way Trip");
            $("#end_location").removeClass('d-none');
            endMap.invalidateSize();
            isRoundTrip = false;
            endMarker = L.marker([endLocationLat, endLocationLng],{
                icon: endIcon,
                draggable: true,
            }).addTo(endMap);
            updateField("end",{lat: endLocationLat, lng: endLocationLng});
            endMarker.on('dragend', function (e){
                updateField("end",e.target.getLatLng());
            });
        }
    }
}

$("#round_trip_button").on('click',function(){
    if(isRoundTrip){
        $("#round_trip_button").removeClass('btn-success').addClass('btn-outline-success').text("One Way Trip");
        $("#end_location").removeClass('d-none');
        endMap.invalidateSize();
        isRoundTrip = false;
    }
    else{
        $("#round_trip_button").removeClass('btn-outline-success').addClass('btn-success').text("Round Trip");
        $('#end_location_lat').val('');
        $('#end_location_lng').val('');
        if(endMarker)
        endMarker.remove();
        endMarker = false;
        $("#end_location").addClass('d-none');
        isRoundTrip = true;
    }
});


