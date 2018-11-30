$(document).ready(function(){
    $('.slide').on('click', function () {
        $('#search-box').toggleClass('show')
    });


    // function search
    $('.slide').on('click', function (){
        if($("#search-on").css("visibility") == "hidden" || $(".word-box").css("visibility") == "visible"){
            $("#search-on").css("visibility", "visible");
            $(".word-box").css("visibility", "hidden");
            $("#material-icons-search").css("visibility", "hidden");
            $("#material-icons-clear").css("visibility", "visible");
        }
        else {
            $(".word-box").css("visibility", "visible");
            $("#material-icons-search").css("visibility", "visible");
            $("#material-icons-clear").css("visibility", "hidden");
        };
    });
/*
    $('.container-video-over').on('click', function(){
        $(".container-video-over").toggleClass(".onclick");
    });*/

    $('.container-video-over').on('click', function(){
        if($(".container-video-over").css("height") != "100%") {
            $(".container-video-over").css("height", "100%");
        }
        else {
            $(".container-video-over").css("height", "25%");
        }
    });
});