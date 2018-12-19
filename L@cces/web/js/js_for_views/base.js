$(document).ready(function () {

    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
        /*isOpen: function (el) {
            console.log("ouvert");
        }*/
    });

    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });
});
