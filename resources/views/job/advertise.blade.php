@extends('layout.template-user')
@section('content')
<script src="{{ asset('js/cart.js') }}"></script>
<script type="text/javascript">

$(document).ready(function(){
Cart.init({
type : 'job-boards',
actionUrl: "{{ route('cart') }}",
getCountUrl: "{{ route('getCartCount') }}",
checkoutUrl: "{{ route('ajax_cart') }}",
cartAddText: '<i class="fa fa-plus"></i> Post for &#8358;',
cartRemoveText: '<i class="fa fa-trash"></i> Remove from Cart ',
cartAddClass: 'btn-success',
cartRemoveClass: 'btn-line'
});
});
</script>
<div class="separator separator-small"></div>
<section class="no-pad">
  <div class="container">
    
    <!--
    <div class="row text-center">
      <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <h5 class="no-margin text-uppercase l-sp-5 text-brandon">Promote your Job</h5>
      </div>
    </div>
    -->
    <div class="row">
      <div class="col-sm-12">
        <div class="page">
          
          @if(empty($slug))
          <div class="btn-group btn-group-justified text-uppercase btn-progress" role="group" aria-label="...">
            <!-- <div class="btn-group" role="group">
              <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                &nbsp; <span class="hidden-xs">1. job details</span></a>
              </div> -->
              <div class="btn-group" role="group">
                <a href="" type="button" class="btn btn-primary text-capitalize"><i class="fa fa-send"></i>
                  &nbsp; <span class="hidden-xs"> advertise</span></a>
                </div>
                
                <div class="btn-group" role="group">
                  <a href="share-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-share-alt"></i>
                    &nbsp; <span class="hidden-xs"> sharing </span></a>
                  </div>
                  <div class="btn-group" role="group">
                    <a href="" type="button" class="btn btn-line text-capitalize"><i class="fa fa-search-plus"></i>
                      &nbsp; <span class="hidden-xs"> add candidates </span></a>
                    </div>
          </div>
          @endif
                  <div class="row">
                    
                    
                    <div class="col-md-10 col-md-offset-1"><br>
                      <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        
                        <div class="btn-group" role="group">
                          <button type="button" class="btn disabled text-capitalize"><i class="fa fa-send"></i>
                          &nbsp; <span class="hidden-xs">Job Promotion</span></button>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="{{ route('add-candidates', false) }}" type="button" class="btn btn-line text-capitalize text-muted"><i class="fa fa-plus"></i>
                            &nbsp; <span class="hidden-xs">Add candidates</span></a>
                          </div>
                        </div>
                        <div>
                          
                          @if (Session::has('flash_message'))
                          <div class="alert alert-info"><i class="fa fa-check">
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                            </i> {!! Session::get('flash_message') !!}
                          </div>
                          @endif
                          <div class="col-xs-6 col-xs-offset-3"><br>
                            
                            @if($count == 0)
                            <div id="collapseWellCart" class="well well-cart animated slideInUp collapse no-margin">
                              @else
                              <div id="collapseWellCart" class="well well-cart animated slideInUp no-margin">
                                @endif
                                <div class="row">
                                  <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                                    <span> <i class="fa fa-shopping-cart fa-3x"></i>
                                    </span>
                                  </div>
                                  <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                                    <span id="item-count">
                                      @if(empty($cart))
                                      <span class="bounceInDown fa-2x" style="display: inline-block;">0</span>
                                      @else
                                      <span class="bounceInDown fa-2x" style="display: inline-block;">{{ $count }}</span>
                                      @endif
                                    </span>
                                  </div>
                                  <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                                    <span class="pull-right fa-2x">
                                      @if(empty($cart))
                                      <span id="price-total" >0</span>
                                      @else
                                      &#8358;<span id="price-total" >{{ $price }}</span>
                                      @endif
                                    </span>
                                  </div>
                                </div><hr>
                                <div class="row">
                                  <div class="col-xs-6"><a id="checkout" href="#" target="_blank" data-toggle="modal" data-target="#myInvoice" data-pass="{{ csrf_token() }}" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                                  <div class="col-xs-6"><button id="clearCart" class="btn btn-block btn-line btn-sm btn-cart-clear text-muted" data-pass="{{ csrf_token() }}"><i class="fa fa-close"></i> Clear</button></div>
                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div>
                            <div class="row">
                              <div class="col-xs-12 text-center">
                                <h4 class=""><br>Promote <a href="">Job Title should come here</a>. </h4><p>Multipying your talent flow. Post your job on more job boards</p><hr>
                              </div>

                              
                                  <div class="col-xs-12">
                              <div class="alert alert-info">
                                    <h4 class="text-brandon text-center text-uppercase">
                                    <i class="fa fa-star"></i>&nbsp; Paid Job Boards
                                    </h4><br>


                              @foreach($job_boards as $b)
                              <div class="col-sm-4">
                                <div class="thumbnail thumb-box">
                                  <div class="caption">
                                    <img alt="" src="{{ $b['img'] }}" height="45px" style="max-width:100%;"> <hr>
                                    <h4 class="">{{ $b['name'] }}</h4>
                                    <p class="small">{{ $b['about'] }}</p>
                                    <p>
                                      <span class="purchase-action">
                                        <?php
                                        if($ids != null){
                                        $in_cart = in_array($b['id'], $ids);
                                        // dd($b['id']);
                                        }else{
                                        $in_cart = "";
                                        }
                                        ?>
                                        @if($in_cart)
                                        <button id="cartRemove" class="btn btn-line" data-id="{{ $b['id'] }}"  data-count="1" data-cost="{{ $b['price'] }}" data-pass="{{ csrf_token() }}" data-name="{{ $b['name'] }}" ><i class="fa fa-trash"></i> Remove from Cart </button>
                                        @else
                                        <a id="cartAdd" class="btn btn-success " data-count="1" data-id="{{ $b['id'] }}" data-cost="{{ $b['price'] }}" data-pass="{{ csrf_token() }}" data-name="{{ $b['name'] }}"><i class="fa fa-plus"></i> Post for &#8358; {{ $b['price'] }}</a>
                                        @endif
                                        
                                      </span>
                                    </p>
                                      </div>
                                    </div>
                                  </div>
                                  @endforeach
                                  <div class="clearfix"></div>


                                <div class="row hidden">
                                  <div class="col-xs-6 col-xs-offset-3"><hr>
                                  <i class="fa fa-spin fa-circle-o-notch fa-2x"></i>
                                  <p class="">
                                    <i class="fa fa-check"></i> Your request has been sent. You will be contacted shortly. Thank you.
                                  </p>
                                    <a href="" class="btn btn-danger btn-block">Forward Request</a>
                                  </div>
                                </div>
                                  <div class="clearfix"></div>

                              </div>
                                  </div>
                            </div>

                            <div class="row">
                              
                              
                              <div class="col-xs-12"><hr>
                                
                                <div class="well text-center">

                                <h4 class="text-brandon text-uppercase text-danger">
                                <i class="fa fa-star"></i>&nbsp; Paid Newspaper Ads
                                </h4>
                                <p>Select the Newspaper where you want you job to appear and click forward request and we will reach you shortly.</p><hr>

                                
                                @foreach($newspapers as $k => $n)
                                <div class="col-sm-4">
                                <label for="fl-box-{{ $k }}">
                                  <div class="thumbnail thumb-box">
                                    <div class="caption">
                                      <img alt="" src="{{ $n->img }}" height="45px" width="100%"> <hr>
                                      <h4 class="">{{ $n->name }}</h4>
                                      <p class="small">{{ $n->about }}</p>
                                      <input type="checkbox" class="fl-box" name="" id="fl-box-{{ $k }}">
                                      <p>
                                        
                                        <span class="purchase-action">
                                          <?php
                                          /*if($ids != null){
                                          $in_cart = in_array($b['id'], $ids);
                                          // dd($b['id']);
                                          }else{
                                          $in_cart = "";
                                          }*/
                                          ?>
                                          
                                          @if($in_cart)
                                          <!-- <button class="btn btn-line " data-count="1" data-id="{{ $n['id'] }}" data-cost="500" onclick="DeleteBoardCart({{ $b['id'] }})"><i class="fa fa-trash"></i> Remove from Cart </button> -->
                                          @else
                                          <!-- <a href="" class="btn btn-success " data-count="1" onclick="AddBoardCart({{ $n['id'] }}, {{ $n['price'] }}, '{{ $n["name"] }}')" data-cost="{{ $n['price'] }}"><i class="fa fa-plus"></i> Post for &#8358; {{ $n['price'] }}</a> -->
                                          
                                          @endif
                                        </span>
                                        
                                      </p>
                                    </div>
                                  </div>
                                </label>
                                </div>
                                @endforeach


                                  <div class="hidden" href="#">
                                    <div class="panel panel-default panel-course category-item">
                                      <div class="row category-row">
                                        <div class="col-xs-3">
                                          <img src="http://d19lga30codh7.cloudfront.net/wp-content/uploads/2013/12/vanguardlogo.png" alt="" class="category-icon" width="100%">
                                        </div>
                                        <div class="col-xs-6">
                                          <h4>Name of Newspaper comes here <small></small> </h4>
                                          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse nam. Deserunt delectus ex enim assumenda.</p> -->
                                        </div>
                                        <div class="col-xs-3 category-item"><br>
                                          <a class="btn btn-block btn-warning pull-right">Request slot</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="hidden" href="#">
                                    <div class="panel panel-default panel-course category-item">
                                      <div class="row category-row">
                                        <div class="col-xs-3 ">
                                          <img src="http://cdn.guardian.ng/wp-content/themes/guardian2016/img/guardian_logo.png" alt="" class="category-icon" width="100%">
                                        </div>
                                        <div class="col-xs-6">
                                          <h4>Name of Newspaper comes here <small></small></h4>
                                          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse nam. Deserunt delectus ex enim assumenda.</p> -->
                                        </div>
                                        <div class="col-xs-3 category-item"><br>
                                          <a class="btn btn-block btn-warning pull-right">Request slot</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>


                                <div class="row hidden">
                                  <div class="col-xs-6 col-xs-offset-3"><hr>
                                  <i class="fa fa-spin fa-circle-o-notch fa-2x"></i>
                                  <p class="">
                                    <i class="fa fa-check"></i> Your request has been sent. You will be contacted shortly. Thank you.
                                  </p>
                                    <a href="" class="btn btn-danger btn-block">Forward Request</a>
                                  </div>
                                </div>
                                  <div class="clearfix"></div>

                                </div>
                                
                              </div>
                              
                              
                              
                              <!-- </div> -->
                              
                              <div class="col-sm-12 text-center"><hr>
                                <a href="#" id="proceed-btn" target="_blank" data-toggle="modal" data-target="#myInvoice" class=" btn btn-danger btn-lg btn-cart-checkout"> Forward Request </a>
                                <a href="{{ route('share-job', [$jobid]) }}" id="skip-btn" class="btn-lg btn btn-line btn-cart-checkout">Cancel &raquo;</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <!--/tab-content-->
                  </div>
                </div>
              </div>
            </section>
            <div class="modal fade" tabindex="-1" id="myInvoice" role="dialog" aria-labelledby="myInvoice">
              <div class="modal-dialog">
                <div class="modal-content"><br>
                  <h3 class="text-center">Confirm your order</h3><hr>
                  
                  <div id="invoice-res">
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-condensed hidden" >
              <thead>
                <tr>
                  <th>Your Selection</th>
                  <th>Cost (₦)</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="cart-preview">
                
              </tbody><thead>
              <tr>
                <th>Total</th>
                <th id="cart-total">0</th>
                <th> &nbsp; </th>
              </tr>
            </thead>
            
          </table>
          <div class="separator separator-small"></div>
          <script type="text/javascript">
          
          // $(document).ready(function(){
          function AddBoardCart(id, price, name){
          console.log('Id is '+ id +' and price is '+ price);
          var url = "{{ route('cart') }}"
          
          $.ajax
          ({
          type: "POST",
          url: url,
          data: ({ rnd : Math.random() * 100000, board_id: id, name:name, type:'add', 'qty':1, 'price':price, "_token":"{{ csrf_token() }}", cart_type:'jobBoards'}),
          success: function(response){
          console.log(response);
          $(this).calculateCartTotal();
          }
          });
          }
          function DeleteBoardCart(id){
          console.log(id);
          var url = "{{ route('cart') }}"
          
          $.ajax
          ({
          type: "POST",
          url: url,
          data: ({ rnd : Math.random() * 100000, board_id: id, type:'remove', "_token":"{{ csrf_token() }}", cart_type:'jobBoards'}),
          success: function(response){
          console.log(response);
          $(this).calculateCartTotal();
          }
          });
          }
          function ClearBoardCart(){
          console.log('Clear all');
          var url = "{{ route('cart') }}"
          
          $.ajax
          ({
          type: "POST",
          url: url,
          data: ({ rnd : Math.random() * 100000, type:'clear', "_token":"{{ csrf_token() }}", cart_type:'jobBoards'}),
          success: function(response){
          console.log(response);
          location.reload();
          }
          });
          }
          // });
          var url = "{{ route('ajax_cart') }}";
          
          $("#checkout").click(function(){
          console.log(url)
          $("#invoice-response").html('<img src="{{ asset("img/wheel.gif") }}" width="100px" /> please wait...');
          $.ajax
          ({
          type: "POST",
          url: url,
          data: ({ rnd : Math.random() * 100000, "_token":"{{ csrf_token() }}", cart_type:'jobBoards'}),
          success: function(response){
          
          $('#invoice-response').html(response)
          
          }
          });
          });
          //--------Buy BOARD and update cart--------//
          //var cv_cart = 0;
          // var p_total = 0;
          var cart_count = {{ \App\Libraries\Utilities::getBoardCartCount() }};
          $('.btn-board-buy').on('click',function(e){
          console.log('Board thuis')
          var each_cart = ($(this).attr('data-cost'));
          $('#cart-preview').append('<tr data-id="' + $(this).attr('data-id') +'" data-owner="' + $(this).attr('data-owner') +'"><td id="name">' + $(this).attr('data-title') +'</td><td id="amount">' + $(this).attr('data-cost') +'</td><td class="text-right"><a href="javascript://" id="delete-request"><i class="fa fa-times-circle text-danger"></i> </a></td></tr>');
          $(this).calculateCartTotal();
          
          cart_count = Number(cart_count) + 1;
          // p_total = 1000 * cart_count;
          
          e.preventDefault();
          $(this).parents('.purchase-action').find('.btn-board-discard').removeClass('collapse');
          $(this).addClass('collapse');
          $('#collapseWellCart').removeClass('collapse');
          $(".btn-cart-checkout").removeClass("disabled");
          $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
          // $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');
          });
          $.fn.calculateCartTotal = function(){
          // var total = 0;
          // var total = {{ \App\Libraries\Utilities::getBoardCartCost() }};
          //   $('#cart-preview #amount').each(function( index ) {
          //       total += parseInt( $( this ).text() );
          //   });
          
          //     console.log('This tot is'+total)
          cart_amounts = $('.btn-board-buy.collapse').map(function(){ return $(this).attr('data-cost') });
          var total = 0;
          $.each(cart_amounts,function() {
          total += parseInt( this );
          });
          if( total > 0 )
          {
          $('#skip-btn').hide();
          $('#proceed-btn').show();
          }
          else
          {
          $('#proceed-btn').hide();
          $('#skip-btn').show();
          }
          $('#cart-total').text(  total  );
          $('#price-total').text(  total  );
          }
          //$(this).calculateCartTotal();
          
          var totalNew = {{ \App\Libraries\Utilities::getBoardCartCost() }};
          // console.log('Can '+totalNew)
          //--------Remove item from Cart--------//
          $('.btn-board-discard').on('click',function(e){
          var each_cart = ($(this).attr('data-cost'));
          var each_id = ($(this).attr('data-id'));
          console.log('each amount is '+each_cart);
          console.log('each id is '+each_id);
          // console.log('cart amount is '+cart_count);
          
          cart_count = Number(cart_count) - 1;
          // p_total = 1000 * cart_count;
          // console.log('total amount is '+totalNew);
          // console.log('NEW total amount is '+ (total));
          // console.log('cart count is '+cart_count);
          
          //console.log('New cart count is '+cv_cart+' and New cost is '+p_total);
          //  //console.log(cv_cart);
          e.preventDefault();
          $(this).parents('.purchase-action').find('.btn-board-buy').removeClass('collapse');
          $(this).addClass('collapse');
          $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
          // $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');
          // if(p_total == 0){
          //      $(".btn-cart-checkout").addClass("disabled");
          //      return p_total;
          //  }
          });
          //--------Clear Cart button--------////
          // $('.btn-cart-clear').on('click',function(e){
          //     cart_count = 0;
          //     p_total = 0;
          
          //     e.preventDefault();
          //     $('.btn-cv-buy').removeClass('collapse');
          //     $('.btn-cv-discard').addClass('collapse');
          //     // $(".btn-cart-checkout").addClass("disabled");
          //    $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block;"><b>'+cart_count+'</b></span>');
          //    $('#price-total').html('<span class="animated zoomIn" style="display: inline-block;">'+p_total+'</span>');
          //     if(p_total == 0){
          //         $(".btn-cart-checkout").addClass("disabled");
          //         return p_total;
          //     }
          // });
          //--------End CV cart--------//
          </script>
          @endsection
