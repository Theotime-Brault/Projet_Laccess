$(document).ready(function () {

    $('#search-barre').on('focus', function(){
        $('.container-focus').toggleClass('container-focus-active');
    });


    $('#search-barre').on('blur', function(){
        $('.container-focus').removeClass('container-focus-active');
    });
});