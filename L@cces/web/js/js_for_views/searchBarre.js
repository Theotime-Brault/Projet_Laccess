$('document').ready(function () {
    $('#btnSearch').click(function () {
        submitSearch();
    })

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
})