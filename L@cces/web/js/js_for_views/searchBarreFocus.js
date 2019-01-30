$(document).ready(function () {
    $("#search-barre").on("focus", function(){
        $(".container-focus-footer").css("animation", "fadeOutDown 250ms");
        $(".container-focus-footer").css("opacity", "0");

        $(".container-main").toggleClass("container-main-active");
        $(".container-main-active").removeClass("container-main");
        $(".container-search").toggleClass("container-search-active");
        $(".container-search-active").removeClass("container-search");
        $("#btnSearch").fadeOut();
        $('#search-on').css({
            height: "40px",
            "transition-duration": "200ms"});
        $('#result').css('display', 'block');
        $(".row-container").slideToggle("400", function () {
            setTimeout(function () {
                $("#close-barre").fadeIn();
                $("#container-img-flag").fadeIn();
            }, 200);
        });

    });

    $("#close-barre").click(function(){
        $(".container-main-active").toggleClass("container-main");
        $(".container-main").removeClass("container-main-active");
        $(".container-search-active").toggleClass("container-search");
        $(".container-search").removeClass("container-search-active");
        $(".row-container").slideToggle("200");
        setTimeout(function() {
            $(".container-focus-footer").css("animation", "fadeInUp 1s");
            $(".container-focus-footer").css("opacity", "1");
        }, 200);
        $("#search-on").css({
            height: "56px"});
        $('#result').css('display', 'none');
        $('#result').html("");
        $("#search-barre").blur();
        $("#close-barre").fadeOut(10);
        $("#container-img-flag").fadeOut(10);
        $("#btnSearch").fadeIn();
    });

    $("#img2").click(function () {
        $("#img1").css("display , block");
        $("#img2").css("display, none");
        $("#img1").fadeIn();
        $("#img2").fadeOut();

    });

    $("#img1").click(function () {
        $("#img2").css("display, block");
        $("#img1").css("display, none");
        $("#img2").fadeIn();
        $("#img1").fadeOut();
    });

});