let raceIcon = L.icon({
    iconUrl: "/images/icons/map/race_flag_square.png",
    iconSize: [40,40],
});
let rideIcon = L.icon({
    iconUrl: "/images/icons/map/bike_green_square.png",
    iconSize: [40,40],
});

var eventMap = L.map('eventMap').setView([defaultLocationLat, defaultLocationLng], 11);
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
    if($("#filterForm").validate().valid()===false){
        return false;
    }
    let bounds = eventMap.getBounds();
    // check if all popups are closed
    for(let i=0; i<eventsMarkers.length; i++){
        if(eventsMarkers[i].isPopupOpen()){
            return false;
        }
    }

    loadEvents(bounds.getSouthWest().lat,bounds.getSouthWest().lng,bounds.getNorthEast().lat,bounds.getNorthEast().lng);
}
function loadEvents(latSW, lngSW, latNE, lngNE){
    let url ="/events/bounds";
    let isRace = 2;
    if(onlyRaces != 1){
        isRace = $('#is_race').val();
    }
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
            "lngNE": lngNE,
            "is_race": isRace,
            'sport_type': $('#sport_type').val(),
            "start_time_from": $('#start_time_from').val(),
            'start_time_to': $('#start_time_to').val(),
            "speed_from": $('#speed_from').val(),
            'speed_to': $('#speed_to').val(),
            "distance_from": $('#distance_from').val(),
            "distance_to": $('#distance_to').val(),
            "elevation_from": $('#elevation_from').val(),
            "elevation_to": $('#elevation_to').val(),

        },
        success: function(data){
            displayEventsOnMap(data);
            showEventsInCards(data);
        },
        error: function (msg) {
        }
    });
}
function displayEventsOnMap(newEvents){
    for(let i=0; i<eventsMarkers.length; i++){
        eventsMarkers[i].remove();
    }
    eventsMarkers = [];
    for(let i=0; i<newEvents.length; i++){
        let icon = rideIcon;
        if(newEvents[i].isRace === true){
            icon = raceIcon;
        }
        let popup = L.popup().setContent(
            getPopupContent(newEvents[i])
            );
        let marker = (L.marker([newEvents[i].start_location_lat,newEvents[i].start_location_lng],{
            icon: icon,
            draggable: false,
        }).addTo(eventMap).bindPopup(popup));
        eventsMarkers.push(marker);
    }
}
function getPopupContent(event){
    let start_date_time = new Date(Date.parse(event.start_time));
     return `
 <table class="table table-sm text-center">
                    <tbody>
                        <tr>
                            <th class="align-middle">Organiser</th>
                            <td>
                                ${event.user.name}
                            </td>
                        </tr>
                    <tr>
                        <th>Sport</th>
                        <td>${event.type_of_sport.name}</td>
                    </tr>
                   <tr>
                        <th>Event</th>
                        <td>${event.name}</td>
                    </tr>
                    <tr>
                        <th>Start</th>
                        <td>${start_date_time.toLocaleDateString()+" "+start_date_time.toTimeString().substr(0, 5)}</td>
                    </tr>
                    <tr>
                        <th>Going</th>
                        <td>${event.number_of_participants}</td>
                    </tr>
                    <tr>
                        <th>Distance</th>
                        <td>
                            ${metricUnits==true?
                                event.distance+" km" : Math.round((event.distance/1.609) * 10) / 10+" mi"}
                        </td>
                    </tr>
                    <tr>
                        <th>Elevation</th>
                        <td>
                         ${metricUnits==true?
                            event.elevation+" m" :    Math.round(event.elevation*3.281)+" ft"}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a type="button" target="_blank" style="color:white !important;" class="btn btn-success btn-block link-as-text" ${event.isRace? "href='/race/"+event.id+"'" : "href='/ride/"+event.id+"'"}>Details</a>
                        </td>
                    </tr>


                    </tbody>
                </table>
  </div>
`;
}

// FILTERS

$('.filterInput').on('change', function () {
    loadEventsInScope();
});
