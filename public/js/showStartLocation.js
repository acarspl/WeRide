startIcon = L.icon({
    iconUrl: "/images/icons/map/flag_start.png",
    iconSize: [40,40],
    iconAnchor: [10,40],
});
var startMap = L.map('start_map_'+iteration).setView([lat, lng], 14);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 17,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: mapBoxToken,
}).addTo(startMap);
L.marker([lat,lng],{
    icon: startIcon,
    draggable: false,
}).addTo(startMap);
