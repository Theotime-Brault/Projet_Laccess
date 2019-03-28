$(document).ready(function () {
    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
    });

    $('.material-icons-dropdown').dropdown({
        alignment: "left",
        coverTrigger: false,
        constrainWidth: false,
    });

    $('#material-icons-dropdown-flag').dropdown({
        coverTrigger: false,
    });

    $('#material-icons-dropdown-flag').dropdown({
        coverTrigger: false,
    });

    $('#dropdown-flag-exercice').dropdown({
        coverTrigger: false,
    });

    $(".exercices").on("click", function(){

    });

    $('.collapsible').collapsible();

    //display tooltipped only on desktop
    if(!( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ))
    {
        $('.tooltipped').tooltip({
            enterDelay: 500,
        });
    }

    //chrono message flash
    $(function() {
        $('.message-flash').delay(2000).fadeOut();
    });

    $('input.formValue, textarea.formValue').characterCounter();

});
