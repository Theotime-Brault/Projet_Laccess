$(document).ready(function () {
    /*
    $('#search-barre').on('focus', function(){
        $('.container-focus').toggleClass('container-focus-active');
    });


    $('#search-barre').on('blur', function(){
        //$('.container-focus').toggleClass('container-focus');
        $('.container-focus').css('visibility', 'visible');
        $('.container-focus').css('display', 'block');
    });
*/
    if($('#search-barre').is(":focus")){
        $(".container-focus").css("visibility", "hidden");
        $(".container-focus").css("display", "none");
    } else {
        $(".container-focus").css("visibility", "visible");
        $(".container-focus").css("display", "block");
    }
});