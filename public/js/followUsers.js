function follow($id){
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/user/follow/"+$id,
        success: function(){
            $('#follow-'+$id).addClass('d-none');
            $('#unfollow-'+$id).removeClass('d-none');
            if($('#followers-count').length !=0){
                $('#followers-count').text(parseInt($('#followers-count').text())+1);
            }
        },
        error: function () {
            alert('You cannot follow this user')
        }
    });
}
function unfollow($id){
    $.ajax({
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/user/unfollow/"+$id,
        success: function(){
            $('#follow-'+$id).removeClass('d-none');
            $('#unfollow-'+$id).addClass('d-none');
            if($('#followers-count').length !=0){
                $('#followers-count').text(parseInt($('#followers-count').text())-1);
            }
        },
        error: function () {
            alert('You cannot unfollow this user')
        }
    });
}
