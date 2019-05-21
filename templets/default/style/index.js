$(".g-list .g-list-slide").hover(function() {
  //  $(this).parent().b
    $(this).addClass('on').siblings().removeClass('on');

});
function partnerSwiper() {
    var swiper
    if ($(document).width() > 1200){
        swiper = new Swiper('.partner-content-swiper-container', {
            slidesPerView: 8,
            spaceBetween: 30,
            loop:true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    }else  if ($(document).width() > 998){
        swiper = new Swiper('.partner-content-swiper-container', {
            slidesPerView: 6,
            spaceBetween: 30,
            loop:true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    }else  if ($(document).width() > 768){
        swiper = new Swiper('.partner-content-swiper-container', {
            slidesPerView: 4,
            spaceBetween: 10,
            loop:true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    }else{
        swiper = new Swiper('.partner-content-swiper-container', {
            slidesPerView: 2,
            spaceBetween: 10,
            loop:true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    }
}
partnerSwiper();
window.onresize= function () {
    partnerSwiper();
}
