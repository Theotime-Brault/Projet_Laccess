$(document).ready(function(){
    checked();
    $("#boutonRadioFr").click(function(){
        $("#boutonRadioEn").removeAttr("checked");
        $("#boutonRadioFr").attr("checked", true);
        checked();
        $('#result').html("");
    });

    $("#boutonRadioEn").click(function(){
        $("#boutonRadioFr").removeAttr("checked");
        $("#boutonRadioEn").attr("checked", true);
        checked();
        $('#result').html("");
    });

    function checked(){
        if($("#boutonRadioEn").is(":checked")){

        };

        if($("#btnFr").is(":checked")){

        };
    }
});