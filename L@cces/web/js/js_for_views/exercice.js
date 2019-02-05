$(document).ready(function () {
   $("#proposition").on("focus", function () {
       $(".card-image").slideUp(200);
       $(".card-action").removeClass("hide");
   });

    $("#revoir-video").on("click", function () {
        $(".card-image").slideDown(300);
        $(".card-action").addClass("hide");
    });
});