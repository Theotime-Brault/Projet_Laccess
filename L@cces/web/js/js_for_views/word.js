$(document).ready(function(){
    $('.tooltipped').tooltip();

    $('.fixed-action-btn').floatingActionButton();

    //Appartition de la barre de recherche au clickAction
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


    //Affichage des phrases au clickAction

    $("#display-sentences").click(function(){
        $(".card-image").slideUp("slow");
        $(".context-sentence").slideDown("fast");
        $("#card-video-1").slideDown("slow", function(){
            $("#card-video-1").css("display", "block");
            $("#card-video-1").addClass("m6");
            $("#card-video-1").removeClass("m8 offset-m2");
        });
        $("#card-video-2").slideDown("slow", function(){
            $("#card-video-2").css("display", "block");
            $("#card-video-2").addClass("m6");
            $("#card-video-2").removeClass("m8 offset-m2");
        });
    });

    //Affichage des vidéos au clickAction
    $("#display-videos").click(function(){
        $(".context-sentence").slideUp("fast");
        $(".card-image").slideDown("slow");
        $("#block-video-1").css("display", "block");
        $("#block-video-2").css("display", "block");
        $("#card-video-1").fadeIn("slow", function () {
            $("#card-video-1").addClass("m6");
            $("#card-video-1").removeClass("m8 offset-m2");
        });
        $("#card-video-2").fadeIn("slow", function () {
            $("#card-video-2").addClass("m6");
            $("#card-video-2").removeClass("m8 offset-m2");
        });
    });

    //Lancement des 2 vidéos simultanément au clickAction (non mobile)
    $('#play-videos').on('click', function(ev) {
        $("#block-video-1").css("display", "none");
        $("#block-video-2").css("display", "none");
        $("#video")[0].src += "&autoplay=1";
        ev.preventDefault();
        $("#video1")[0].src += "&autoplay=1";
        ev.preventDefault();
    });


    /*Clique sur partie grise vidéo 1
    -   disparition carte 2
    -   apparition phrase contexte
    */

    $("#block-video-1").on("click", function(){
        $("#block-video-1").css("display", "none");
        if($(window).width() < 600)
        {
            $("#card-video-2").slideUp("slow");
        }
        $("#card-video-2").fadeOut("fast", function () {
            $("#card-video-1").addClass("m8 offset-m2");
            $("#card-video-1").removeClass("m6");
            $("#context-sentence-block-video-1").slideDown("slow");
        });
    });

    /*Clique sur partie grise vidéo 2
    -   disparition carte 1
    -   apparition phrase contexte
    */
    $("#block-video-2").on("click", function() {
        $("#block-video-2").css("display", "none");
        if($(window).width() < 600)
        {
            $("#card-video-1").slideUp("slow");
        }
        $("#card-video-1").fadeOut("fast", function () {
            $("#card-video-2").addClass("m8 offset-m2");
            $("#card-video-2").removeClass("m6");
            $("#context-sentence-block-video-2").slideDown("slow");
        });
    });





    $("#context-sentence-block-video-1").on("click", function () {
        $("#card-video-2").fadeOut("slow", function () {
            $("#card-video-1").addClass("m8 offset-m2");
            $("#card-video-1").removeClass("m6");
            $("#block-video-1").fadeOut("fast");
        });
    });

    $("#context-sentence-block-video-2").on("click", function () {
        $("#card-video-1").fadeOut("slow", function () {
            $("#card-video-2").addClass("m8 offset-m2");
            $("#card-video-2").removeClass("m6");
            $("#block-video-2").fadeOut("fast");
        });
    });







    $("#context-sentence-block-video-1").on("click", function () {
        if($("#card-video-2").css("display") == "none") {
            $("#card-video-1").css("display", "none");
            $("#card-video-2").css("display", "block");
            $(".card-image").css("display", "block");
            $("#card-video-2").addClass("m8 offset-m2");
            $("#card-video-2").removeClass("m6");
            $("#block-video-2").css("display", "none");
        }
    });

    $("#context-sentence-block-video-2").on("click", function () {
        if($("#card-video-1").css("display") == "none"){
            $("#card-video-2").css("display", "none");
            $("#card-video-1").css("display", "block");
            $(".card-image").css("display", "block");
            $("#card-video-1").addClass("m8 offset-m2");
            $("#card-video-1").removeClass("m6");
            $("#block-video-1").css("display", "none");
        }
    });


    if($(window).width() < 600)
    {
        $(".context-sentence").css("display", "none");
    }

    if($(window).width() >= 600)
    {
        $(".context-sentence").css("display", "block");
    }

});