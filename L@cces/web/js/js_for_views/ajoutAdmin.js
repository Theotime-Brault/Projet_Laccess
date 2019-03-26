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

})

function valid(){
    if($('#user_username').val() == "" || $('#user_password_first').val() == "" || $('#user_password_second').val() == ""
        || $('#user_email').val() == ""){
        $('#user_submit').attr({ 'disabled': true });
    }else{
        $('#user_submit').attr({ 'disabled': false });
    }
}

function validUsername() {
    var re = new RegExp("^[a-zA-Z0-9\-\_]{1,30}$")
    res = false;
    if(re.test($('#user_username').val())){
        res = true;
        $('#error_name').html("");
    }else{
        $('#error_name').html("Le nom d'utilisateur doit contenir des caractere alphanumeric");
    }

    return res
}

function validEmail() {
    var re = new RegExp("^[a-zA-Z0-9\-\_]*[\@]{1}[a-zA-Z0-9-_]*[\.]{1}[a-z]*$")

    if(re.test($('#user_email').val())){
        $('#error_name').html("");
    }else{
        $('#error_mail').html("L'email ne convient pas");
    }
}

function validPassword() {
    
}