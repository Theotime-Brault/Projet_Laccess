$(document).ready(function () {
   $("#proposition").on("focus", function () {
       $(".card-image").slideUp(200);
       $(".card-action").removeClass("hide");
   });

    $("#envoyer").on("click", function () {
        var valueIn = $("#proposition").val();
        var word = $("#word").attr("data-word");
        if(word === valueIn) {
            console.log("ça FONCTIONNE");
        }
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