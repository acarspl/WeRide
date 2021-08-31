let raceIcon = L.icon({
    iconUrl: "/images/icons/map/race_flag_square.png",
    iconSize: [40,40],
});
let rideIcon = L.icon({
    iconUrl: "/images/icons/map/bike_green_square.png",
    iconSize: [40,40],
});

var eventMap = L.map('eventMap').setView([51.505, -0.09], 13);
let eventsMarkers=[];

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 17,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: mapBoxToken,
}).addTo(eventMap);
eventMap.on('moveend', function() {
    loadEventsInScope();
});

$(window).on('load', function() {
    loadEventsInScope();
});
function loadEventsInScope(){
    let bounds = eventMap.getBounds();
    loadEvents(bounds.getSouthWest().lat,bounds.getSouthWest().lng,bounds.getNorthEast().lat,bounds.getNorthEast().lng);
}
function loadEvents(latSW, lngSW, latNE, lngNE){
    let url ="/events/bounds";
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: {
            "latSW": latSW,
            "lngSW": lngSW,
            "latNE": latNE,
            "lngNE": lngNE
        },
        success: function(data){
            displayEventsOnMap(data);
        },
        error: function (msg) {
            alert("Something went wrong!")
        }
    });
}
function displayEventsOnMap(newEvents){
    console.log(newEvents);
    for(let i=0; i<eventsMarkers.length; i++){
        eventsMarkers[i].remove();
    }
    for(let i=0; i<newEvents.length; i++){
        let icon = rideIcon;
        if(newEvents[i].isRace === true){
            icon = raceIcon;
        }
        eventsMarkers.push(L.marker([newEvents[i].start_location_lat,newEvents[i].start_location_lng],{
            icon: icon,
            draggable: false,
        }).addTo(eventMap));
    }
}

