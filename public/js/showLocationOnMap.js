startIcon = L.icon({
    iconUrl: "/images/icons/map/flag_start.png",
    iconSize: [40,40],
    iconAnchor: [10,40],
});
var startMap = L.map('location_map_'+iteration).setView([lat, lng], 14);

L.tileLayer('https://b.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 17,
}).addTo(startMap);
L.marker([lat,lng],{
    icon: startIcon,
    draggable: false,
}).addTo(startMap);
