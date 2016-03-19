
$(window).scroll(function() {

    var navbar = $(".navbar.navbar-out");

        if ($(".navbar").offset().top > 100) {

        // animating navbar background
        navbar.removeClass("transparent");

        //Fix or release Cart
        $(".well-cart").addClass("fixer");
    } else {

        // animating navbar background
        navbar.addClass("transparent");

        //Fix or release Cart
        $(".well-cart").removeClass("fixer");
    }
});




$(document).ready(function(){

    //-------- CV cart--------//    
    
    //--------Buy CV and update cart--------//

    var cv_cart = 0;
    var p_total = 0;

    $('.btn-cv-buy').on('click',function(e){

        cv_cart++;
        p_total += 500;
        console.log(cv_cart);

        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-cv-discard').removeClass('collapse');
        $(this).addClass('collapse');
       $('#collapseWellCart').removeClass('collapse');
       $(".btn-cart-checkout").removeClass("disabled");

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cv_cart+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

    });


    //--------Remove item from Cart--------//
    $('.btn-cv-discard').on('click',function(e){

        cv_cart--;
        p_total -= 500;
        console.log(cv_cart);

        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-cv-buy').removeClass('collapse');
        $(this).addClass('collapse');

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cv_cart+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

       if(p_total == 0){
            $(".btn-cart-checkout").addClass("disabled");

            return p_total;
        }

    });

    //--------Clear Cart button--------////

    $('.btn-cart-clear').on('click',function(e){

        cv_cart = 0;
        p_total = 0;
        console.log(cv_cart);

        e.preventDefault();
        $('.btn-cv-buy').removeClass('collapse');
        $('.btn-cv-discard').addClass('collapse');
        // $(".btn-cart-checkout").addClass("disabled");

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block;"><b>'+cv_cart+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block;">'+p_total+'</span>');



        if(p_total == 0){
            $(".btn-cart-checkout").addClass("disabled");

            return p_total;
        }


    });

    //--------End CV cart--------//    
});