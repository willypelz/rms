@extends('layout.template-user')

@section('content')

<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">

                    <div class="row text-center">
                        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                            <h5 class="no-margin text-uppercase l-sp-5 text-brandon">Promote your Job</h5>
                        </div>
                    </div>

            <div class="row">

                <div class="col-sm-12">
                    <br>
                    <div class="page">

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
                            <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs"> add candidates </span></a>
                          </div>
                        </div>
                        <div class="row">
                            
                            
                    <div class="col-md-10 col-md-offset-1"><br>
                        <div>
                                
                                @if (Session::has('flash_message'))
                                    <div class="col-xs-7">
                                        <i class="fa fa-check"></i> {{ Session::get('flash_message') }} <br>
                                    </div>
                                @endif

                                <div class="col-xs-5">
                                    
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
                                                    &#8358;
                                                    @if(empty($cart))
                                                    <span id="price-total" >0</span> 
                                                    @else
                                                    <span id="price-total" >{{ $price }}</span> 
                                                    @endif
                                                </span>
                                            </div>
                                        </div><hr>
                                        <div class="row">
                                            <div class="col-xs-6"><a href="#" id="checkout" target="_blank" data-toggle="modal" data-target="#myInvoice" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                                            <div class="col-xs-6"><button class="btn btn-block btn-line btn-sm btn-cart-clear text-muted" onclick="ClearBoardCart()"><i class="fa fa-close"></i> Clear</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                                <div>
                                  <div class="row">
                                    <div class="col-xs-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis voluptatum unde, placeat repellendus dolores, nam enim eveniet earum eius molestiae explicabo in architecto maiores quaerat voluptatibus iste laudantium quo natus.</p><br>
                                        <h5 class="text-brandon text-uppercase">
                                        <i class="fa fa-star"></i>&nbsp; Paid Job Board 
                                        </h5><br>
                                    </div>
                                       @foreach($board1 as $b)
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail">  
                                                <div class="caption">
                                            <img alt="" src="{{ $b['img'] }}" height="45px"> <hr>
                                                    <h4 class="">{{ $b['name'] }}</h4>
                                                    <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
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
                                                            <button class="btn btn-line btn-board-discard" data-count="1" data-cost="500" onclick="DeleteBoardCart({{ $b['id'] }})"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                        @else
                                                            <a href="" class="btn btn-success btn-board-buy" data-count="1" onclick="AddBoardCart({{ $b['id'] }}, {{ $b['price'] }}, '{{ $b["name"] }}')" data-cost="500"><i class="fa fa-plus"></i> Post for &#8358; {{ $b['price'] }}</a>
                                                            <button class="btn btn-line btn-board-discard collapse" data-count="1" data-cost="500" onclick="DeleteBoardCart({{ $b['id'] }})"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                        @endif
                                                    </span>

                                                    </p> 
                                                </div> 
                                            </div> 
                                        </div>
                                        @endforeach
                                       
                                    </div>
                                        <div class="row">
                                               @foreach($board2 as $b)
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail">  
                                                <div class="caption">
                                            <img alt="" src="{{ $b['img'] }}" height="45px"> <hr>
                                                    <h4 class="">{{ $b['name'] }}</h4>
                                                    <p class="small"> Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
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
                                                                <button class="btn btn-line btn-board-discard collapse" data-count="1" data-cost="500" onclick="DeleteBoardCart({{ $b['id'] }})"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                            @else
                                                                <a href="" class="btn btn-success btn-board-buy" data-count="1" data-cost="500" onclick="AddBoardCart({{ $b['id'] }}, {{ $b['price'] }}, '{{ $b["name"] }}')"><i class="fa fa-plus"></i> Post for &#8358; {{ $b['price'] }}</a>
                                                                <button class="btn btn-line btn-board-discard collapse" data-count="1" data-cost="500" onclick="DeleteBoardCart({{ $b['id'] }}) "><i class="fa fa-trash"></i> Remove from Cart </button>
                                                            @endif
                                                    </span>

                                                    </p> 
                                                </div> 
                                            </div> 
                                        </div>
                                        @endforeach
                                       
                                        <div class="col-sm-12"><hr><a href="{{ route('share-job', [$jobid]) }}" class="pull-right btn btn-danger btn-cart-checkout">Skip &raquo;</a></div>
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
        <div class="modal-content">

            <h3 class="text-center">Confirm your order</h3>
            
                <div id="invoice-response">
                </div>
        </div>
      </div>
    </div>



<div class="separator separator-small"></div>

<script type="text/javascript">
    
     //$(document).ready(function(){

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


</script>



@endsection