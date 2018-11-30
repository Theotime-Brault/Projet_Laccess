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

    $('.container-video-over1').on('click', function(){
        if($(".container-video-over1").css("height") != "100%"){
            $(".container-video2").css("display", "none");
            $(".container-video1").css("height", "100%");
            $(".container-video-over1").css({
                opacity: 0,
                display: "none"
            });
            $("iframe").css({
                width: '100%',
                height: '50vh',
                display: "block"
            });
            $(".contextSentence").css("display", "block");
        }
    });

    $('.container-video-over2').on('click', function(){
        if($(".container-video-over2").css("height") != "100%"){
            $(".container-video1").css("display", "none");
            $(".container-video2").css("height", "100%");
            $(".container-video-over1").css({
                opacity: 0,
                display: "none"
            });
            $("iframe").css({
                width: '100%',
                height: '50vh',
                display: "block"
            });
            $(".contextSentence").css("display", "block");
        }
    });
});