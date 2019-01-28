$(document).ready(function () {

    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
    });

    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });

    //chrono message flash
    $(function() {
        $('.message-flash').delay(2000).fadeOut();
    });


});
