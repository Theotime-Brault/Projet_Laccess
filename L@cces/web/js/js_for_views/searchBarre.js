$('document').ready(function () {
    $('#btnSearch').click(function () {
        submitSearch();
    });

    if($("#btnFr").is(":checked")) {
        $("#imgFlagFr").parent().css("background-color", "#f4a733");
        $("#imgFlagEn").parent().css("background-color", "white");
    }else if($("#btnEn").is(":checked")) {
        $("#imgFlagEn").parent().css("background-color", "#f4a733");
        $("#imgFlagFr").parent().css("background-color", "white");
    }

    function submitSearch(){
        var  word = $('#search-barre').val();
        var langue;
        if($("#btnFr").is(":checked")) {
            langue = "fr";
        }else if($("#btnEn").is(":checked")) {
            langue = "en";
        }else{
            langue = "";
        }

        if(word && langue){
            $('form').attr('action', "/word/"+langue+"/"+word);
            $('form').submit();
        }else{
            $('form').removeAttr('action');
        }
    }

    $('#search-barre').keyup(function(e) {
        if (e.keyCode == 13) {
            submitSearch();
        }
    });

    $("#imgFlagFr").click(function(){
        $("#btnEn").removeAttr("checked");
        $("#btnFr").attr("checked", true);
        $("#imgFlagFr").parent().css("background-color", "#f4a733");
        $("#imgFlagEn").parent().css("background-color", "white");
    });

    $("#imgFlagEn").click(function(){
        $("#btnFr").removeAttr("checked");
        $("#btnEn").attr("checked", true);
        $("#imgFlagEn").parent().css("background-color", "#f4a733");
        $("#imgFlagFr").parent().css("background-color", "white");
    });
})