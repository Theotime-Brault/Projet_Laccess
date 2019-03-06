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
                "<div class='row'><input class='otherRep col s11' required=\"required\" type=\"text\" placeholder='entrer une autre réponse'></input><div id='ajouterChamp' class='col s1'></div></div>"
            )
            break;
        case '3':
            $('#ex').html("" +
                "<label>Lien vidéo</label>" +
                "<input id='videoLink' required=\"required\" type=\"text\" placeholder='entrer le lien de la video'></input>" +
                "<label>Bonne réponse</label>" +
                "<input id='solution' required=\"required\" type=\"text\" placeholder='entrer la bonne réponse'></input>" +
                "<label>Autre réponse</label>" +
                "<div class='row'><input class='otherRep col s11' required=\"required\" type=\"text\" placeholder='entrer une autre réponse'></input><div id='ajouterChamp' class='col s1'></div></div>"
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
        $('#ajouterChamp').html("<a class='btn background-color-orange-lacces' onclick='ajouter()'><i class='material-icons'>add</i></a>")
    }else{
        $('.add').remove();
    }
});

function ajouter() {
    $('#valid').before(
        "<div class='row add'>" +
        "<input required=\"required\" class='otherRep col s11' type=\"text\" placeholder='entrer une autre réponse'></input>" +
        "<a class='btn background-color-orange-lacces col s1'><i class='material-icons'>remove</i></a>" +
        "</div>"
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