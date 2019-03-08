$('#typeEx').change(function () {
    switch ($('#typeEx option:selected').val()) {
        case '1':
            $('#ex').html("" +
                "<div class='input-field'>" +
                "<label>Lien vidéo</label>" +
                "<input id='videoLink' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Solution</label>" +
                "<input id='solution' required=\"required\" type=\"text\"></input>" +
                "</div>"
            );
            break;
        case '2':
            $('#ex').html("" +
                "<div class='input-field'>" +
                "<label>Enoncé</label>" +
                "<input id='enonce' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Bonne réponse</label>" +
                "<input id='solution' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Autre réponse</label>" +
                "<input class='otherRep col s10' required=\"required\" type=\"text\"></input></div><div id='ajouterChamp' class='col s2'></div>"
            );
            break;
        case '3':
            $('#ex').html("" +
                "<div class='input-field'>" +
                "<label>Lien vidéo</label>" +
                "<input id='videoLink' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Bonne réponse</label>" +
                "<input id='solution' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Autre réponse</label>" +
                "<input class='otherRep col s10' required=\"required\" type=\"text\"></input></div><div id='ajouterChamp' class='col s2'></div>"
            );
            break;
        case '4':
            $('#ex').html("" +
                "<div class='input-field'>" +
                "<label>Enoncé</label>" +
                "<input id='enonce' required=\"required\" type=\"text\"></input>" +
                "</div>" +
                "<div class='input-field'>" +
                "<label>Solution</label>" +
                "<input id='solution' required=\"required\" type=\"text\"></input>" +
                "</div>"
            );
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
    $('#ex').append(
        "<div class='row add'>" +
        "<input required=\"required\" class='otherRep col s10' type=\"text\" placeholder='entrer une autre réponse'></input>" +
        "<a class='btn background-color-orange-lacces col s2' onclick='enlever(this)'><i class='material-icons'>remove</i></a>" +
        "</div>"
    )
};

function enlever(a){
    $(a).parent().remove();
}

function OtherRepString() {
    var res = "";
    $('.otherRep').each(function () {
        res += "_"
        res += $(this).val();
    });
    res = res.substring(1);
}

function succes() {
    alert("Exercice ajouté!");
    $('#typeEx').val(0);
    $('#words').val(0);
    $('#ex').html("");
}