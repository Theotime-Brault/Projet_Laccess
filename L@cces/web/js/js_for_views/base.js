$(document).ready(function () {

    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
    });

    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });
});
