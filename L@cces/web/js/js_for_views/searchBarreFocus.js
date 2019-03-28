$(document).ready(function () {

    $("#search-barre").on("focus", function(){
        $(".container-focus-footer").css("animation", "fadeOutDown 250ms");
        $(".container-focus-footer").css({
            opacity: "0",
            display: "none",
        });
        $(".container-main").addClass("container-main-active");
        $(".container-main-active").removeClass("container-main");
        $(".container-search").addClass("container-search-active");
        $(".container-search-active").removeClass("container-search");
        $("#btnSearch").css({
            "transition-duration": "100ms",
            right: "1.2rem",
        });
        $('#search-on').css({
            height: "40px",
            "transition-duration": "100ms"});
        $('#result').css('display', 'block');
        $(".row-container").slideUp("150", function () {
            setTimeout(function () {
                $("#close-barre").fadeIn();
                $("#material-icons-dropdown-flag").fadeIn();
                $("#background-search").css("display", "block");
            }, 100);
        });
    });

    $("#close-barre").click(function(){
        hiddenSearchBase();
    });

    $("#background-search").click(function(){
        hiddenSearchBase();
    });

    $("#search-barre").keyup(function(e) {
        if (e.keyCode == 27) {
            hiddenSearchBase();
        }
    });

    function hiddenSearchBase() {
        $("#background-search").css("display", "none");
        $(".container-main-active").toggleClass("container-main");
        $(".container-main").removeClass("container-main-active");
        $(".container-search-active").toggleClass("container-search");
        $(".container-search").removeClass("container-search-active");
        $(".row-container").slideDown("100");
        setTimeout(function() {
            $(".container-focus-footer").css("animation", "fadeInUp 750ms");
            $(".container-focus-footer").css({
                opacity: "1",
                display: "block",
            });
        }, 200);
        $("#search-on").css({
            height: "56px"});
        $('#result').css('display', 'none');
        $('#result').html("");
        $("#search-barre").blur();
        $("#close-barre").fadeOut(10);
        $("#material-icons-dropdown-flag").fadeOut(10);
        $("#btnSearch").css({
            "transition-duration": "100ms",
            right: "0",
        });
    }
});