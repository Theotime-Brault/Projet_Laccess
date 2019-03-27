$(document).ready(function () {
    valid();

    $('#user_username, #user_password_first, #user_password_second, #user_email').keyup(function () {
        valid();
    })

    $('#user_username').keyup(function () {
        validUsername();
    })

    $('#user_email').keyup(function () {
        validEmail();
    })

    $('#user_password_first').keyup(function () {
        validPassword();
    })

});

function valid(){
    if($('#user_username').val() == "" || $('#user_password_first').val() == "" || $('#user_password_second').val() == ""
        || $('#user_email').val() == ""){
        $('#user_submit').attr({ 'disabled': true });
    }else{
        $('#user_submit').attr({ 'disabled': false });
    }
}

function validUsername() {
    var re = new RegExp("^[a-zA-Z0-9\-\_]{1,30}$");
    if(re.test($('#user_username').val())){
        $('#error_name').html("");
    }else{
        $('#error_name').html("Le nom d'utilisateur doit contenir des caracteres alphanumerique");
    }
}


function validEmail() {
    var re = new RegExp("^[a-z0-9._-]+@[a-z0-9._-]+\\.[a-z]{2,6}$");
    if(re.test($('#user_email').val())){
        $('#error_mail').html("");
    }else{
        $('#error_mail').html("Entrez un email valide");
    }
}

function validPassword() {
    var re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\\W).{8,32}$");
    if(re.test($('#user_password_first').val())){
        $('#error_pw').html("");
    }else{
        $('#error_pw').html("Le mot de passe doit contenir au moins un caractère minuscule<br/>" +
                              "Le mot de passe doit contenir au moins un caractère majuscule<br/>" +
                              "Le mot de passe doit contenir au moins un chiffre<br/>" +
                              "Le mot de passe doit contenir au moins un caractère spécial<br/>" +
                              "Le mot de passe doit contenir de 8 à 32 caractères");
    }
}