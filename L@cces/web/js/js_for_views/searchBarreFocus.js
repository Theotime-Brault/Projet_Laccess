$(document).ready(function () {
    $('#search-barre').on('focus', function(){
        $('.container-focus').toggleClass('container-focus-active');
        $('#container-search').toggleClass('container-focus-active-search');
        $('#container-search').toggleClass('container-focus-active-container-search');
        $('main').toggleClass('container-focus-active-main');
        $('#search-on').css({
            height: '36px',
            'transition-duration': '200ms'});
    });


    $('#search-barre').on('blur', function(){
        $('.container-focus').removeClass('container-focus-active');
        $('#container-search').removeClass('container-focus-active-search');
        $('main').removeClass('container-focus-active-main');
        $('#container-search').removeClass('container-focus-active-container-search');
        $('#search-on').css('height', '56px');
    });
});