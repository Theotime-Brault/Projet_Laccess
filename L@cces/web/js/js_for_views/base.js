$(document).ready(function () {

    $('.sidenav').sidenav({
        closeOnClick: true,
        draggable: true,
    });
/*
    $(".material-icons-dropdown").click(function(){
        $(".dropdown-content-l").slideDown(100);
    });

    $(".container-body").on("click", function(){
        $(".dropdown-content-l").slideUp(100);
    });
*/
    $('.material-icons-dropdown').dropdown({
        alignment: "left",
        coverTrigger: false,
        constrainWidth: false,
    });

    $('#material-icons-dropdown-flag').dropdown({
        coverTrigger: false,
    });

    $(".exercices").on("click", function(){

    });


    $('.collapsible').collapsible();

    $('#collapsible-header-click').on('click', function () {
        $('.material-icons').toggleClass('rotate')
    });

    $('.tooltipped').tooltip({
        enterDelay: 700,
    });

    //chrono message flash
    $(function() {
        $('.message-flash').delay(2000).fadeOut();
    });


});
