$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();

    //Appartition de la barre de recherche au clickAction
    $("#search-box-click").on("click", function(){
        $("#search-box").css("display", "block").css("animation", "slideInDown 400ms");
        $("input").focus();
        setTimeout(function () {
            $("#close-barre").fadeIn(10);
            $("#material-icons-dropdown-flag").fadeIn(10);
        }, 200);
    });

    $("#close-barre").click(function(){
        $("#search-box").css("animation", "slideOutUp 200ms");
        setTimeout(function () {
            $("#search-box").css("display", "none");
        }, 150);
        $("#close-barre").fadeOut(10);
        $("#material-icons-dropdown-flag").fadeOut(10);
    });

    //Lancement des 2 vidéos simultanément au clickAction (non mobile)


    /*$(".play").on("click", function(ev) {
        $(".block-video").fadeOut("fast");
        $("#video-word-1")[0].src += "&autoplay=1";
        ev.preventDefault();
        $("#video-word-2")[0].src += "&autoplay=1";
        ev.preventDefault();
        });
    */



    var video = document.getElementById("video-word-1");
    $('.play').click(function() {
        $(".block-video").fadeOut("fast");
        video.start = true;
        //video.load();
    });
});