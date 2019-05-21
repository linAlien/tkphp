$(document).ready(function() {

    "use strict";
    $('.banner-box').waypoint(function() {
        setTimeout(function(){
            $('.banner-box').addClass('animated fadeInDownBig')
        },200);
    }, { offset: '65%'});

    $('.function-info-content .g-list').waypoint(function() {
        setTimeout(function(){
            $('.function-info-content .g-list').addClass('animated fadeInUpBig')
        },200);
    }, { offset: '65%'});

    $('.fun1').waypoint(function() {
        setTimeout(function(){
            $('.fun1 .fun1-left').addClass('animated fadeInLeftBig')

        },200);
        setTimeout(function () {
            $('.fun1 .fun1-right').addClass('animated fadeInRightBig')
        },400);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m1').addClass('animated fadeIn')
        },1000);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m2').addClass('animated fadeIn')
        },1200);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m3').addClass('animated fadeIn')
        },1500);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m4').addClass('animated fadeIn')
        },2000);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m5').addClass('animated fadeIn')
        },2400);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m6').addClass('animated fadeIn')
        },1600);
        setTimeout(function () {
            $('.fun1 .fun1-right .fun1-m7').addClass('animated fadeIn')
        },3000);
    }, { offset: '65%'});

    $('.fun2').waypoint(function() {
        setTimeout(function () {
            $('.fun2 .fun2-left').addClass('animated fadeInLeftBig')

        }, 200);
        setTimeout(function () {
            $('.fun2 .fun2-right').addClass('animated fadeInRightBig')
        }, 400);
    }, { offset: '65%'});

    $('.fun3').waypoint(function() {
        setTimeout(function () {
            $('.fun3 .fun3-left').addClass('animated fadeInLeftBig')
        }, 200);
        setTimeout(function () {
            $('.fun3 .fun3-right').addClass('animated fadeInRightBig')
        }, 400);
    }, { offset: '65%'})

});

