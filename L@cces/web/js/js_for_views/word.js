$(document).ready(function(){
    $('.tooltipped').tooltip();

    $('.fixed-action-btn').floatingActionButton();

    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

    //Appartition de la barre de recherche au clickAction
    $("#search-box-click").on("click", function(){
        $("#search-box").css("display", "block");
        $("#search-box").css("animation", "slideInDown 400ms");
        $("input").focus();
    });
/*
    $("#search-barre").on("blur", function(){
        $("#search-box").css("animation", "slideOutUp 200ms");
        setTimeout(function () {
            $("#search-box").css("display", "none");
        }, 150);
    });
*/

    //Affichage des phrases au clickAction
/*
    $("#display-sentences").click(function(){
        $(".card-image").slideUp("slow");
        $(".context-sentence").slideDown("slow");
        $("article").slideDown("slow", function() {
            $("article").css("display", "block");
            $("article").addClass("m6");
            $("article").removeClass("m8 offset-m2");
        });
    });
*//*
    //Affichage des vidéos au clickAction
    $("#display-videos").click(function(){
        $(".context-sentence").slideUp("fast");
        $(".card-image").slideDown("slow");
        $("#block-video-1").fadeIn("fast");
        $("#block-video-2").fadeIn("fast");
        $("article").fadeIn("slow", function () {
            $("article").addClass("m6");
            $("article").removeClass("m8 offset-m2");
        });
    });
*/
    //Lancement des 2 vidéos simultanément au clickAction (non mobile)

    var video = document.getElementById('video');
    var play = document.getElementsByClassName('play');

    play.addEventListener("click", function() {
        video.play();
    });


    $("#article-card-1").click(function () {
        $("#block-video-1").fadeOut("fast");
        $("#block-video-2").fadeIn("fast");
    });

    $("#article-card-2").click(function () {
        $("#block-video-2").fadeOut("fast");
        $("#block-video-1").fadeIn("fast");
    });

    $("#article-card-sentence-1").click(function () {
        $("#block-video-sentence-1").fadeOut("fast");
        $("#block-video-sentence-2").fadeIn("fast");
    });

    $("#article-card-sentence-2").click(function () {
        $("#block-video-sentence-2").fadeOut("fast");
        $("#block-video-sentence-1").fadeIn("fast");
    });

/*

    $("#article-card-1").click(function () {
        $("#block-video-1").fadeOut("fast");
        $("#article-card-2").fadeOut("slow", function(){
            $("article").addClass("m8 offset-m2");
            $("article").removeClass("m6");
            $(".context-sentence").slideDown("slow");
            if($("#card-video-1").css("display") == "none"){
                $("#card-video-1").slideDown("slow");
            }
        });
    });

    $("#article-card-2").click(function () {
        $("#block-video-2").fadeOut("fast");
        $("#article-card-1").fadeOut("slow", function(){
            $("article").addClass("m8 offset-m2");
            $("article").removeClass("m6");
            $(".context-sentence").slideDown("slow");
            if($("#card-video-2").css("display") == "none"){
                $("#card-video-2").slideDown("slow");
            }
        });
    });


    $("#context-sentence-block-video-1").click(function () {
        if($("#article-card-2").css("display") == "none"){
            $("#article-card-1").fadeOut();
            $("#article-card-2").fadeIn();
        }
    });/*
    $("#context-sentence-block-video-2").on("click", function () {
        if($("#article-card-1").css("display") == "none"){
            //$("#article-card-2").hide();
            $("#article-card-1").show();
        }
    });*/
/*
    if($(window).width() < 600)
    {
        $(".context-sentence").css("display", "none");
    }

    if($(window).width() >= 600)
    {
        $(".context-sentence").css("display", "block");
    }*/

});