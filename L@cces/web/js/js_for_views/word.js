$(document).ready(function(){
    $('.tooltipped').tooltip();

    $('.fixed-action-btn').floatingActionButton();

    $("#search-box-click").on("click", function(){
       $("#search-box").css("display", "block");
       $("#search-box").css("animation", "slideInDown 400ms");
       $("input").focus();
    });

    $("#search-barre").on("blur", function(){
        $("#search-box").css("animation", "slideOutUp 200ms");
        setTimeout(function () {
            $("#search-box").css("display", "none");
        }, 150);
    });

    $("#display-sentences").on("click", function(){
        $(".card-image").slideUp("slow");
        if($(".context-sentence").css("display") == "none") {
            $(".context-sentence").slideDown("fast");
        }
        $(".card-video-1").slideDown("slow", function(){
            $("#card-video-1").css("display", "block");
            $("#card-video-1").addClass("m6");
            $("#card-video-1").removeClass("m8 offset-m2");
        });
        $(".card-video-2").slideDown("slow", function(){
            $("#card-video-2").css("display", "block");
            $("#card-video-2").addClass("m6");
            $("#card-video-2").removeClass("m8 offset-m2");
        });
    });

    $("#display-videos").on("click", function(){
        $(".context-sentence").slideUp("slow");
        if($(".card-image").css("display") == "none") {
            $(".card-image").slideDown("slow");
        }



        $(".card-image").css("display", "block");
        $("#block-video-1").css("display", "block");
        $("#block-video-2").css("display", "block");
        /*
        $("#card-video-1").css("display", "block");
        $("#card-video-2").css("display", "block");
        $("#card-video-2").addClass("m6");
        $("#card-video-2").removeClass("m8 offset-m2");
        $("#card-video-1").addClass("m6");
        $("#card-video-1").removeClass("m8 offset-m2");*/
    });


    $('#play-videos').on('click', function(ev) {
        $("#block-video-1").css("display", "none");
        $("#block-video-2").css("display", "none");
        $("#video")[0].src += "&autoplay=1";
        ev.preventDefault();
        $("#video1")[0].src += "&autoplay=1";
        ev.preventDefault();
    });


    $("#block-video-1").on("click", function(){
        $("#block-video-1").css("display", "none");
        /*
        $("#card-video-1").css("transition-duration", "1200ms");
        $("#card-video-1").css("width", "100%");
        $("#card-video-1").css("height", "100%");*/
        $("#card-video-2").fadeOut("scale", function () {
            $("#card-video-1").addClass("m8 offset-m2");
            $("#card-video-1").removeClass("m6");
        });

        /*$(".card-video-2").css("transition-duration", "1200ms");*/
        //$(".card-video-2").css("display", "none");
       /* $(".card-video-2").css("width", "0");
        $(".card-video-2").css("height", "0");
        setTimeout(function () {
            $(".card-video-2").css("display", "none");
        }, 800);*/
    });


    $("#block-video-2").on("click", function() {
        $("#block-video-2").css("display", "none");
        /*
        $("#card-video-2").css("transition-duration", "1200ms");
        $("#card-video-2").css("width", "100%");
        $("#card-video-2").css("height", "100%");
        */
        $("#card-video-1").fadeOut("scale", function () {
            $("#card-video-2").addClass("m8 offset-m2");
            $("#card-video-2").removeClass("m6");
        });



        /*
        $("#card-video-1").css("transition-duration", "1200ms");
        */
        //$("#card-video-1").css("display", "none");
        /*
        $("#card-video-1").css("width", "0");
        $(".card-video-1").css("height", "0");
        setTimeout(function () {
            $(".card-video-1").css("display", "none");
        }, 800);*/
    });

/*
    $("#context-sentence-block-video-1").on("click", function () {
        $(".card-video-1").css("display", "none");
        $(".card-video-2").css("display", "block");
        $(".card-image").css("display", "block");
        $(".card-video-2").addClass("m8 offset-m2");
        $(".card-video-2").removeClass("m6");
        $("#block-video-2").css("display", "none");
    });

    $("#context-sentence-block-video-2").on("click", function () {
        $(".card-video-2").css("display", "none");
        $(".card-video-1").css("display", "block");
        $(".card-image").css("display", "block");
        $(".card-video-1").addClass("m8 offset-m2");
        $(".card-video-1").removeClass("m6");
        $("#block-video-1").css("display", "none");
    });
*/
    if($(window).width() < 600)
    {
        $(".context-sentence").css("display", "none");
    }

    if($(window).width() >= 600)
    {
        $(".context-sentence").css("display", "block");
    }

});