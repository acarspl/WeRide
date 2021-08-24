let startIcon = L.icon({
   iconUrl: "/images/icons/map/flag_start.png",
    iconSize: [40,40],
    iconAnchor: [10,40],
});
let startMarker = null;

var startMap = L.map('start_location_map').setView([51.505, -0.09], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 17,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: mapBoxToken,
}).addTo(startMap);
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


