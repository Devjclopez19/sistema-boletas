"use strict";
$(document).ready(function() {
    // $('.theme-loader').addClass('loaded');
    $('.theme-loader').animate({
        'opacity': '0',
    }, 1);
    setTimeout(function() {
        $('.theme-loader').remove();
    }, 1);
    //$('.pcoded').addClass('loaded');
});
