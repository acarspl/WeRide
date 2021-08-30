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
            }
            else{
                $('#join_event_button_'+id).removeClass('d-block').addClass('d-none');
                $('#leave_event_button_'+id).removeClass('d-none').addClass('d-block');
            }
        },
        error: function (msg) {
            alert("Something went wrong!")
        }
    });
}
function leaveEvent(id, isRace){

}

