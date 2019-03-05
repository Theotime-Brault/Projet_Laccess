$(document).ready(function () {
    $(".tabs").tabs();

    document.addEventListener("DOMContentLoaded", function(){
        $(".preloader-background").hide();
    });

    $("#exerciceA1Link").click(function () {
        $("#exerciceA1").load(ajaxExercice("{{ path('lacces_exerciceA1') }}", "#exerciceA1"));
    });

    $("#exerciceA2Link").click(function () {
        $("#exerciceA2").load(ajaxExercice("{{ path('lacces_exerciceA2') }}", "#exerciceA2"));
    });

    $("#exerciceBLink").click(function () {
        $("#exerciceB").load(ajaxExercice("{{ path('lacces_exerciceB') }}", "#exerciceB"));
    });

    $("#exerciceCLink").click(function () {
        $("#exerciceC").load(ajaxExercice("{{ path('lacces_exerciceC') }}", "#exerciceC"));
    });

    $("#exerciceDLink").click(function () {
        $("#exerciceD").load(ajaxExercice("{{ path('lacces_exerciceD') }}", "#exerciceD"));
    });

    function ajaxExercice (path, blockResponse){
        $.ajax({
            cache:false,
            type: "POST",
            dataType: "JSON",
            url: path,
            data: {'langue':"en"},
            beforeSend: function(){
                $(blockResponse).css("visibility", "hidden");
                $(".preloader-background").show();
            },
            success: function(response)
            {
                $(blockResponse).html(response);
                $(".preloader-background").hide();
                $(blockResponse).css("visibility", "visible");
            },
        });
    }
});