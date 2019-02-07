$(document).ready(function () {

    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
    });

    $(".dropdown-trigger").click(function(){
        $(".dropdown-content-l").slideDown(100);
    });

    $(".container-body").on("click", function(){
        $(".dropdown-content-l").slideUp(100);
    });



    $(".exercices").on("click", function(){

    });


    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });

    $('.tooltipped').tooltip();

    //chrono message flash
    $(function() {
        $('.message-flash').delay(2000).fadeOut();
    });


});
