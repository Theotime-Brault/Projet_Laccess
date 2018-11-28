$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();

    $('.collapsible-header').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });
});
