$(window).scroll(function() {
    if ($(".navbar.navbar-out").offset().top > 150) {
        $(".navbar-fixed-top").removeClass("transparent");
    } else {
        $(".navbar-fixed-top").addClass("transparent");
    }
});

$('.verify-div')
.mouseenter(function(){
    $(this).find('div.callout').fadeIn(100);
})
.mouseleave(function(){
    $(this).find('div.callout').fadeOut(100);
});