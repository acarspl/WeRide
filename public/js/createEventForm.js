// SPORT SELECTOR
$(".sport_type_box").on('click',function (e) {
    $('.sport_type_box').find('img').addClass('typeOfSportImage');
    $('.sport_type_box').find('h4').addClass('typeOfSportText').removeClass('bg-black');
    $('#'+this.children[0].id).removeClass('typeOfSportImage');
    $('#'+this.children[1].id).removeClass('typeOfSportText');
    $('#'+this.children[1].id).addClass('bg-black');
    switch(this.id){
        case 'road_cycling_box':
            $("#sport_type_id").val(1);
            break;
        case "mtb_box":
            $("#sport_type_id").val(4);
            break;
        case "gravel_box":
            $("#sport_type_id").val(2);
            break;
        case "bike_touring_box":
            $("#sport_type_id").val(3);
            break;
        case "enduro_box":
            $("#sport_type_id").val(5);
            break;

        default:
                console.log("Error, no type selected!");
    }
});
