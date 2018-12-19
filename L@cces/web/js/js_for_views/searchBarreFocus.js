$(document).ready(function () {
    $('#search-barre').on("focus", function(){
        $("main").removeClass("container-switch-main");
        $('.container-focus').toggleClass("container-focus-active");
        $('#container-search').toggleClass("container-focus-active-container-search");
        $('#container-search').toggleClass("container-focus-active-search");
        $("main").toggleClass("container-focus-active-main");
        $('#search-on').css({
            height: "36px",
            "transition-duration": "200ms"});
    });


    $("#search-barre").on("blur", function(){
        setTimeout(function(){
            $(".container-focus").removeClass("container-focus-active");
            $("main").removeClass("container-focus-active-main");

        },650);
        $("#container-search").removeClass("container-focus-active-container-search");
        $("#container-search").removeClass("container-focus-active-search");
        $("main").toggleClass("container-switch-main");
        $("#search-on").css({
            height: "56px"});
    });
});