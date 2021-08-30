function joinEvent(id, isRace){
    let url ="";
    if(isRace){
         url = "/race/"+id+"/join" ;
    }
    else{
        url = "/ride/"+id+"/join" ;
    }
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        success: function(){
            if(isRace){
                $('#join_event_button_'+id+'_r').removeClass('d-block').addClass('d-none');
                $('#leave_event_button_'+id+'_r').removeClass('d-none').addClass('d-block');
                $('#number_of_participants_'+id+'_r').text(parseInt($('#number_of_participants_'+id+'_r').text())+1);
            }
            else{
                $('#join_event_button_'+id).removeClass('d-block').addClass('d-none');
                $('#leave_event_button_'+id).removeClass('d-none').addClass('d-block');
                $('#number_of_participants_'+id).text(parseInt($('#number_of_participants_'+id).text())+1);
            }
            if($('#me_participating_row')){
                $('#me_participating_row').removeClass('d-none').addClass('d-table-row');
            }
        },
        error: function (msg) {
            alert("Something went wrong!")
        }
    });
}
function leaveEvent(id, isRace){
    let url ="";
    if(isRace){
        url = "/race/"+id+"/leave" ;
    }
    else{
        url = "/ride/"+id+"/leave" ;
    }
    $.ajax({
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        success: function(){
            if(isRace){
                $('#join_event_button_'+id+'_r').removeClass('d-none').addClass('d-block');
                $('#leave_event_button_'+id+'_r').removeClass('d-block').addClass('d-none');
                $('#number_of_participants_'+id+'_r').text(parseInt($('#number_of_participants_'+id+'_r').text())-1);
            }
            else{
                $('#join_event_button_'+id).removeClass('d-none').addClass('d-block');
                $('#leave_event_button_'+id).removeClass('d-block').addClass('d-none');
                $('#number_of_participants_'+id).text(parseInt($('#number_of_participants_'+id).text())-1);
            }
            if($('#me_participating_row')){
                $('#me_participating_row').removeClass('d-table-row').addClass('d-none');
            }
        },
        error: function () {
            alert("You cannot leave the event!")
        }
    });
}

