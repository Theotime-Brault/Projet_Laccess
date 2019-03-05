$('#typeEx').change(function () {
    switch ($('#typeEx option:selected').val()) {
        case '1':
            $('#ex').html("" +
                "<label>Lien vidéo</label>" +
                "<input id='videoLink' required=\"required\" type=\"text\" placeholder='entrer le lien de la video'></input>" +
                "<label>Solution</label>" +
                "<input id='solution' required=\"required\" type=\"text\" placeholder='entrer la solution'></input>"
            )
            break;
        case '2':
            $('#ex').html("" +
                "<label>Enoncé</label>" +
                "<input id='enonce' required=\"required\" type=\"text\" placeholder='entrer l énoncé'></input>" +
                "<label>Bonne réponse</label>" +
                "<input id='solution' required=\"required\" type=\"text\" placeholder='entrer la bonne réponse'></input>" +
                "<label>Autre réponse</label>" +
                "<input class='otherRep' required=\"required\" type=\"text\" placeholder='entrer une autre réponse'></input>"
            )
            break;
        case '3':
            $('#ex').html("" +
                "<label>Lien vidéo</label>" +
                "<input id='videoLink' required=\"required\" type=\"text\" placeholder='entrer le lien de la video'></input>" +
                "<label>Bonne réponse</label>" +
                "<input id='solution' required=\"required\" type=\"text\" placeholder='entrer la bonne réponse'></input>" +
                "<label>Autre réponse</label>" +
                "<input class='otherRep' required=\"required\" type=\"text\" placeholder='entrer une autre réponse'></input>"
            )
            break;
        case '4':
            $('#ex').html("" +
                "<label>Enoncé</label>" +
                "<input id='enonce' required=\"required\" type=\"text\" placeholder='entrer l énoncé'></input>" +
                "<label>Solution</label>" +
                "<input id='solution' required=\"required\" type=\"text\" placeholder='entrer la solution'></input>"
            )
            break;
        default:
            $('#ex').html("");
            break;
    }

    if($('#typeEx option:selected').val() == '2' || $('#typeEx option:selected').val() == '3'){
        $('.add').remove();
        $('form').after("<button class='background-color-orange-lacces add material-icons' onclick='ajouter()'><i>add</i></button>")
    }else{
        $('.add').remove();
    }
});

function ajouter() {
    $('#valid').before(
        "<span>" +
        "<input required=\"required\" class='add otherRep' type=\"text\" placeholder='entrer une autre réponse'></input>" +
        "</span>" +
        "<a><i class='material-icons'>remove</i></a>"
    )
};

function enlever() {
    
}

function OtherRepString() {
    var res = "";
    $('.otherRep').each(function () {
        res += $(this).val();
        res += "_"
    })

    return res;
}