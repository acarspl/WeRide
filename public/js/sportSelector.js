// SPORT SELECTOR
$(".sport_type_box").on('click',function (e) {
    $('#select_sport_alert').addClass('d-none');
    $('.sport_type_box').find('img').addClass('fadedImage');
    $('.sport_type_box').find('h4').addClass('fadedText').removeClass('bg-green');
    $('#'+this.children[0].id).removeClass('fadedImage');
    $('#'+this.children[1].id).removeClass('fadedText').addClass('bg-green');
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
//EDIT FORM:
if(sportSelector){
    sportSelector = parseInt(sportSelector);
    $("#sport_type_id").val(sportSelector);
    $('.sport_type_box').find('img').addClass('fadedImage');
    $('.sport_type_box').find('h4').addClass('fadedText').removeClass('bg-green');
    switch(sportSelector){
        case 1:
            $('#road_cycling_image').removeClass('fadedImage');
            $('#road_cycling_text').removeClass('fadedText').addClass('bg-green');
            break;
        case 2:
            $('#gravel_image').removeClass('fadedImage');
            $('#gravel_text').removeClass('fadedText').addClass('bg-green');
            break;
        case 3:
            $('#bike_touring_image').removeClass('fadedImage');
            $('#bike_touring_text').removeClass('fadedText').addClass('bg-green');
            break;
        case 4:
            $('#mtb_image').removeClass('fadedImage');
            $('#mtb_text').removeClass('fadedText').addClass('bg-green');
            break;
        case 5:
            $('#enduro_image').removeClass('fadedImage');
            $('#enduro_text').removeClass('fadedText').addClass('bg-green');
            break;

        default:
            console.log("Error, no type selected!");
    }
}
