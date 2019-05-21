$("#nav-toggle").click(function () {
    $('body').toggleClass('navbar-toggle-btn');
});

function goTop() {
    $(window).scroll(function() {
        var $scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop; //兼容浏览器
        if($scrollTop > 100) { //滚动高度可调
            $(".navbar-fixed-top").addClass('scrollTop');
        } else {
            $(".navbar-fixed-top").removeClass('scrollTop');
        };
    })
}
goTop();