$(document).click(function(a){var e=["#navbar-menu","#navbar-more"];$(a.target).is("a")?$(e).collapse("hide"):$(e).collapse("hide")}),$(".opera-nav").click(function(a){a.preventDefault()}),$(document).ready(function(){$("#testifier").owlCarousel({autoplay:!0,loop:!0,dots:!1,navigation:!0,items:1,margin:0,stagePadding:0,smartSpeed:450}),$("#discoveryBanner").owlCarousel({autoplay:!0,autoplayTimeout:1e4,video:!0,responsiveClass:!0,responsive:{0:{items:1,nav:!1,loop:!1,nav:!0,navText:['<i class="fa fa-2x fa-arrow-circle-left"></i>','<i class="fa fa-2x fa-arrow-circle-right"></i>']},768:{items:2,margin:15,loop:!0,nav:!1},1024:{items:2,margin:25,loop:!0,nav:!0,navText:['<i class="fa fa-3x fa-arrow-circle-left"></i>','<i class="fa fa-3x fa-arrow-circle-right"></i>']}}}),$(".like-post").click(function(){$(this).find(".fa-stack-1x").toggleClass("fa-heart-o fa-heart")}),$("#videoboxSlider").owlCarousel({loop:!0,dots:!1,margin:10,responsiveClass:!0,responsive:{0:{items:1,nav:!1},600:{items:2,nav:!1},768:{items:4,nav:!0,navText:['<i class="fa fa-2x fa-chevron-circle-left"></i>','<i class="fa fa-2x fa-chevron-circle-right"></i>']}}}),$("#form-scroller").owlCarousel({autoplay:!0,loop:!1,nav:!0,dots:!1,mouseDrag:!1,touchDrag:!1,items:1,smartSpeed:500,margin:50}),$("#courseBanner").owlCarousel({loop:!1,responsiveClass:!0,responsive:{0:{items:1,nav:!0},600:{items:2,nav:!0,margin:10},768:{items:3,margin:25,nav:!0},1024:{items:4,margin:25,nav:!0}}})});