jQuery(document).ready(function ($) {
    $('.counter').counterUp({
        delay: 100,
        time: 1200
    });

    setTimeout(function () {
        $('body').addClass('loaded');
        $('h1').css('color', '#222222');
    }, 1000);


});


