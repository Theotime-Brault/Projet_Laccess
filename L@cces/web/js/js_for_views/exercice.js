$(document).ready(function () {
   $("#proposition").on("focus", function () {
       $(".card-image").slideUp(200);
       $(".card-action").removeClass("hide");
   });

    $("#revoir-video").on("click", function () {
        $(".card-image").slideDown(300);
        $(".card-action").addClass("hide");
    });

    $("#card-content-1").on("click", function () {
        $("#card-image-1").slideToggle("fast");
    });

    $("#card-content-2").on("click", function () {
        $("#card-image-2").slideToggle("fast");
    });
});