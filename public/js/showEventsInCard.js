function showEventsInCards(newEvents){
    $('.show_event_card').each(function () {
        this.remove();
    });
    let events = '';
    for(let i=0; i<newEvents.length;i++){
        events += `
       <div class="card show_event_card mt-2 mx-auto text-center">
    <div class="card-header bg-green mx-0  text-white">
            <img class="mb-1"  src="${newEvents[i].isRace===true?"/images/icons/map/race_flag.png":"/images/logo/bike.png"}" style='width: 20px' >

        <span class="font-weight-bold mx-2">${newEvents[i].name}</span> <span> ${new Date(Date.parse(newEvents[i].start_time)).toLocaleDateString()} ${new Date(Date.parse(newEvents[i].start_time)).toTimeString().substr(0, 5)}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
               <div id="location_map_${i}" style="height: 300px">
               </div>
               <script type="text/javascript">
               startIcon = L.icon({
                    iconUrl: "/images/icons/map/flag_start.png",
                    iconSize: [40,40],
                    iconAnchor: [10,40],
                });
                var startMap = L.map('location_map_'+${i}).setView([${newEvents[i].start_location_lat}, ${newEvents[i].start_location_lng}], 14);

        L.tileLayer('https://b.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            maxZoom: 17,
        }).addTo(startMap);
                L.marker([${newEvents[i].start_location_lat}, ${newEvents[i].start_location_lng}],{
                    icon: startIcon,
                    draggable: false,
                }).addTo(startMap);
</script>
            </div>
            <div class="col-6 my-auto">
                <table class="table table-sm ">
                    <tbody>
                        <tr>
                            <th class="align-middle">Organiser</th>
                            <td>
                                ${newEvents[i].user.name}
                            </td>
                        </tr>
                    <tr>
                        <th>Sport</th>
                        <td>${newEvents[i].type_of_sport.name}</td>
                    </tr>
                    <tr>
                        <th>Start</th>
                        <td>${new Date(Date.parse(newEvents[i].start_time)).toLocaleDateString()} ${new Date(Date.parse(newEvents[i].start_time)).toTimeString().substr(0, 5)}</td>
                    </tr>
                    <tr>
                        <th>Distance</th>
                        <td>
                            ${metricUnits==true?
                             newEvents[i].distance+" km" : Math.round((newEvents[i].distance/1.609) * 10) / 10+" mi"}
                        </td>
                    </tr>
                    <tr>
                        <th>Elevation</th>
                        <td>
                         ${metricUnits==true?
            newEvents[i].elevation+" m" :    Math.round( newEvents[i].elevation*3.281)+" ft"}
                        </td>
                    </tr>
                    <tr>
                        <th>Going</th>
                        <td>${newEvents[i].number_of_participants}</td>
                    </tr>
                    <tr>
                        <th class="align-middle">Requirements</th>
                            <td>${(newEvents[i].isRace === false && newEvents[i].helmet_required === 1)?
                                '<img src="/images/icons/requirements/helmet.png" alt="Helmet" width="35px">' :''}
                            ${(newEvents[i].isRace === false && newEvents[i].lights_required === 1)?
                    '<img src="/images/icons/requirements/helmet.png" alt="Helmet" width="35px">' :''}
                               </td>
                    </tr>

                    <tr>
                        <td colspan="2">

                            <a class="btn btn-success btn-block"  href="${(newEvents[i].isRace === true)? "/race/":"/ride/" }${newEvents[i].id}" >Details</a>
                        </td>
                    </tr>


                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

        `;
    }
    $('#events_card_body').append(events);
}
