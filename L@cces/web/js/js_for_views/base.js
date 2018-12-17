$(document).ready(function () {
    $('.sidenav').sidenav();

    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });
});
