$(document).ready(function(){
    $('.slide').on('click', function () {
        $('#search-box').toggleClass('show')
    });


    $('.slide').on('click', function (){
        if($("#search-on").css("visibility") == "hidden"){
            $("#search-on").css("visibility", "visible");
            $(".word-box").css("visibility", "hidden");
        }
        else {
            $(".word-box").css("visibility", "visible");
        };
    });
});