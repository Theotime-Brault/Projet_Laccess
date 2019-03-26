$(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();

    //Appartition de la barre de recherche au clickAction
    $("#search-box-click").on("click", function(){
        $("#search-box").css("display", "block").css("animation", "slideInDown 400ms");
        $("#search-barre").focus();
        setTimeout(function () {
            $("#close-barre").fadeIn(10);
            $("#material-icons-dropdown-flag").fadeIn(10);
            $("#background-search").css("display", "block");
        }, 200);
        $("html").css("overflow", "hidden");
    });

    $("#close-barre").click(function(){
        hiddenSearch();
    });

    $("#background-search").click(function(){
        hiddenSearch();
    });

    $("#search-barre").keyup(function(e) {
        if (e.keyCode == 27) {
            hiddenSearch();
        }
    });

    function hiddenSearch() {
        $("#background-search").css("display", "none");
        $("html").css("overflow", "auto");
        $("#search-box").css("animation", "slideOutUp 200ms");
        setTimeout(function () {
            $("#search-box").css("display", "none");
        }, 150);
        $("#close-barre").fadeOut(10);
        $("#material-icons-dropdown-flag").fadeOut(10);
    }

    //Lancement des 2 vidéos simultanément au clickAction (non mobile)

    $("#play-videos").on("click", function(ev) {
       if($("#word").hasClass("active")){
           $("#video-word-1")[0].src += "&autoplay=1";
           ev.preventDefault();
           $("#video-word-2")[0].src += "&autoplay=1";
           ev.preventDefault();
       } else if ($("#sentences").hasClass("active")) {
           $("#video-sentence-1")[0].src += "&autoplay=1";
           ev.preventDefault();
           $("#video-sentence-2")[0].src += "&autoplay=1";
           ev.preventDefault();
       }
    });
});