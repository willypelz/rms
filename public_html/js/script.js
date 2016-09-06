$(window).scroll(function() {

    var navbar = $(".navbar");

        if ($(".navbar").offset().top > 100) {

        // animating navbar background
        navbar.addClass("fold");

        //Fix or release Cart
        $(".well-cart").addClass("fixer");
    } else {

        // animating navbar background
        navbar.removeClass("fold");

        //Fix or release Cart
        $(".well-cart").removeClass("fixer");
    }
});


if (!sh)
    var sh = window.sh = {};

sh.showModal = function(obj,title,view,data)
{
    $('#viewModal .modal-title').text(title);
    $('.modal-dialog').removeClass('modal').removeClass('modal-lg').addClass(data.modal_size);

    // $user = $(this).closest('.media');
    // var $user = obj.closest('.media').clone();
    // $user.find('input[type="checkbox"]').remove();
    // $user.find('small').remove();
    // data.badge = $user.html();
    
    $.get(view, data, function(response){
        $('#viewModal .modal-body').html( response);

    });
}


sh.showWideModal = function()
{

}

$(document).ready(function(){
    
    $('.modal-header .close');

    $('body').on('click','#modalButton', function(){

        var data = {
            app_id: $(this).attr('data-app-id') ,
            cv_id: $(this).attr('data-cv')
        }

        if( $(this).attr('data-type') == 'normal' )
        {
            data.modal_size = 'modal-md';
            sh.showModal( $(this), $(this).attr('data-title') , $(this).attr('data-view'), data );
        }
        else if( $(this).attr('data-type') == 'wide' )
        {
            data.modal_size = 'modal-lg';
            sh.showModal( $(this), $(this).attr('data-title') , $(this).attr('data-view'), data );
        }
        else if( $(this).attr('data-type') == 'small' )
        {
            data.modal_size = 'modal-sm';
            sh.showModal( $(this), $(this).attr('data-title') , $(this).attr('data-view'), data );
        }
    });

    $('#viewModal').on('hidden.bs.modal', function () {
        $('#viewModal .modal-title').text("Default Text");
        $('#viewModal .modal-body').html( window.preloader );
        console.log( "Modal has been closed" );
    });

    // onclick="sh.showModal('Assess','')"
});
////////-----function for Homepage Tabs---------////////

    //     $(function() {
    //         $('#mydiv>li,#sticky-header ul li').on('click',function(){
    //             $(this).attr('li-nunmber');
    //             return;
    //         });
    //     });

    // function updateLink(){

    //     $('#mydiv>li:eq(0),#sticky-header ul li:eq(0)').click(function(){
    //         $('#sticky-header ul li,#mydiv>li').removeClass('active');
    //         $('#sticky-header ul li:eq(0),#mydiv>li:eq(0)').addClass('active');
    //         $('.tab-pane').removeClass('active');
    //         $('.tab-pane:eq(0)').addClass('active');

    //     });
    //     $('#mydiv>li:eq(1),#sticky-header ul li:eq(1)').click(function(){
    //         $('#sticky-header ul li,#mydiv>li').removeClass('active');
    //         $('#sticky-header ul li:eq(1),#mydiv>li:eq(1)').addClass('active');
    //         $('.tab-pane').removeClass('active');
    //         $('.tab-pane:eq(1)').addClass('active');
    //     });
    //     $('#mydiv>li:eq(2),#sticky-header ul li:eq(2)').click(function(){
    //         $('#sticky-header ul li,#mydiv>li').removeClass('active');
    //         $('#sticky-header ul li:eq(2),#mydiv>li:eq(2)').addClass('active');
    //         $('.tab-pane').removeClass('active');
    //         $('.tab-pane:eq(2)').addClass('active');
    //     });
    //     $('#mydiv>li:eq(3),#sticky-header ul li:eq(3)').click(function(){
    //         $('#sticky-header ul li,#mydiv>li').removeClass('active');
    //         $('#sticky-header ul li:eq(3),#mydiv>li:eq(3)').addClass('active');
    //         $('.tab-pane').removeClass('active');
    //         $('.tab-pane:eq(3)').addClass('active');
    //     });
    // }

////////-----End function for Homepage Tabs---------////////   




// $(document).ready(function(){

//     //--------Homepage Sticky header----------//

//     //updateLink();

//         $('#sticky-header ul li a').on('click',function(){
//             $('html,body').animate({
//                scrollTop: $("#mydiv").offset().top
//             });
//         });

//     //--------End Homepage Sticky header----------//



//     //-------- CV cart--------//    
    
//     //--------Buy CV and update cart--------//

//  var cv_cart = 0;
//  var p_total = 0;

//     $('.btn-cv-buy').on('click',function(e){

//      cv_cart++;
//      p_total += 500;
//      console.log(cv_cart);

//         e.preventDefault();
//         $(this).parents('.purchase-action').find('.btn-cv-discard').removeClass('collapse');
//         $(this).addClass('collapse');
//        $('#collapseWellCart').removeClass('collapse');
//        $(".btn-cart-checkout").removeClass("disabled");

//        $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cv_cart+'</b></span>');
//        $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

//     });


//     //--------Remove item from Cart--------//
//     $('.btn-cv-discard').on('click',function(e){

//      cv_cart--;
//      p_total -= 500;
//      console.log(cv_cart);

//         e.preventDefault();
//         $(this).parents('.purchase-action').find('.btn-cv-buy').removeClass('collapse');
//         $(this).addClass('collapse');

//        $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cv_cart+'</b></span>');
//        $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

//        if(p_total == 0){
//          $(".btn-cart-checkout").addClass("disabled");

//          return p_total;
//      }

//     });

//     //--------Clear Cart button--------////

//     $('.btn-cart-clear').on('click',function(e){

//      cv_cart = 0;
//      p_total = 0;
//      console.log(cv_cart);

//         e.preventDefault();
//         $('.btn-cv-buy').removeClass('collapse');
//         $('.btn-cv-discard').addClass('collapse');
//         // $(".btn-cart-checkout").addClass("disabled");

//        $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block;"><b>'+cv_cart+'</b></span>');
//        $('#price-total').html('<span class="animated zoomIn" style="display: inline-block;">'+p_total+'</span>');



//      if(p_total == 0){
//          $(".btn-cart-checkout").addClass("disabled");

//          return p_total;
//      }


//     });

//     //--------End CV cart--------//    
// });