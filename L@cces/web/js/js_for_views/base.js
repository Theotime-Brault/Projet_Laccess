$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });
/*
    $('.sidenav-trigger').on('click', function () {
        if(".sidenav").is(draggable){
            $('.sidenav').toggleClass('.sidenav-open');
        }
        else{
            $('.sidenav-open').toggleClass('.sidenav-close');
        }


    });*/
});
