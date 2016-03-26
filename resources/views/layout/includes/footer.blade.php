<script>
    $(document).ready(function(){

    //--------Homepage Sticky header----------//

    //updateLink();

        $('#sticky-header ul li a').on('click',function(){
            $('html,body').animate({
               scrollTop: $("#mydiv").offset().top
            });
        });

    //--------End Homepage Sticky header----------//



    //-------- CV cart--------//    
    
    //--------Buy CV and update cart--------//

    //var cv_cart = 0;
    var p_total = 0;
    var cart_count = {{ \App\Libraries\Utilities::getBoardCartCount() }};

    $('.btn-cv-buy').on('click',function(e){

        console.log('Using thuis')
        
        cart_count = Number(cart_count) + 1;
        p_total = 500 * cart_count;
        
        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-cv-discard').removeClass('collapse');
        $(this).addClass('collapse');
       $('#collapseWellCart').removeClass('collapse');
       $(".btn-cart-checkout").removeClass("disabled");

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

    });


    //--------Remove item from Cart--------//
    $('.btn-cv-discard').on('click',function(e){

        console.log('cart count is '+cart_count);
        
        cart_count = Number(cart_count) - 1;
        p_total = 500 * cart_count;

        //console.log('New cart count is '+cv_cart+' and New cost is '+p_total);

       //  //console.log(cv_cart);

        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-cv-buy').removeClass('collapse');
        $(this).addClass('collapse');

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

       if(p_total == 0){
            $(".btn-cart-checkout").addClass("disabled");

            return p_total;
        }

    });








    //--------Buy BOARD and update cart--------//

    //var cv_cart = 0;
    var p_total = 0;
    var cart_count = {{ \App\Libraries\Utilities::getBoardCartCount() }};

    $('.btn-board-buy').on('click',function(e){

        console.log('Board thuis')
        
        cart_count = Number(cart_count) + 1;
        p_total = 1000 * cart_count;
        
        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-board-discard').removeClass('collapse');
        $(this).addClass('collapse');
       $('#collapseWellCart').removeClass('collapse');
       $(".btn-cart-checkout").removeClass("disabled");

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

    });


    //--------Remove item from Cart--------//
    $('.btn-board-discard').on('click',function(e){

        console.log('cart count is '+cart_count);
        
        cart_count = Number(cart_count) - 1;
        p_total = 1000 * cart_count;

        console.log('cart count is '+cart_count);
        
        //console.log('New cart count is '+cv_cart+' and New cost is '+p_total);

       //  //console.log(cv_cart);

        e.preventDefault();
        $(this).parents('.purchase-action').find('.btn-board-buy').removeClass('collapse');
        $(this).addClass('collapse');

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>'+cart_count+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>'+p_total+'</b></span>');

       if(p_total == 0){
            $(".btn-cart-checkout").addClass("disabled");

            return p_total;
        }

    });




    //--------Clear Cart button--------////

    $('.btn-cart-clear').on('click',function(e){

        cart_count = 0;
        p_total = 0;
        
        e.preventDefault();
        $('.btn-cv-buy').removeClass('collapse');
        $('.btn-cv-discard').addClass('collapse');
        // $(".btn-cart-checkout").addClass("disabled");

       $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block;"><b>'+cart_count+'</b></span>');
       $('#price-total').html('<span class="animated zoomIn" style="display: inline-block;">'+p_total+'</span>');



        if(p_total == 0){
            $(".btn-cart-checkout").addClass("disabled");

            return p_total;
        }


    });

    //--------End CV cart--------//    
});
</script>
    <footer>
        <div class="container">

            <div class="row">

                <div class="col-sm-3">
                    <ul class="list-unstyled footer-logo">
                        <li>
                            <h4 class="text-brandon" style="text-transform: capitalize;"> <i class="fa fa-skype"></i> Seamless Hiring</h4>
                            <small class="text-muted">&copy; 2016. All Rights Reserved. <br>An Insidify.com Campany</small>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <ul class="list-unstyled">
                        <li>
                            <h5>Navigation</h5>
                        </li>
                        <li><a href="#">About Us</a>
                        </li>
                        <li><a href="#">Terms & Privacy</a>
                        </li>
                        <li><a href="#">About Us</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <ul class="list-unstyled">
                        <li>
                            <h5>Job Search</h5>
                        </li>
                        <li><a href="#">About Us</a>
                        </li>
                        <li><a href="#">Terms & Privacy</a>
                        </li>
                        <li><a href="#">About Us</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                   <h5>Share this job publishing on LinkedIn, Twitter, Facebook.</h5>
               
                           <a href="" class="">
                                   <span class="fa-stack fa-lg">
                                     <i class="fa fa-circle fa-stack-2x text-"></i>
                                     <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                   </span>
                           </a>
               
                           <a href="" class="">
                                   <span class="fa-stack fa-lg">
                                     <i class="fa fa-circle fa-stack-2x text-"></i>
                                     <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                   </span>
                           </a>
               
                           <a href="" class="">
                                   <span class="fa-stack fa-lg">
                                     <i class="fa fa-circle fa-stack-2x text-"></i>
                                     <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                   </span>
                           </a>
                   </div>
            </div>


        </div><br>
    </footer>



    <!-- Login Modal -->
    <div class="modal animated animated-fast slideInUp" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <section class="no-pad">

                
                    <div class="">
                        <div class="row">

                            <div class="col-sm-12 text-center">
                                <h2>Seamless Hiring</h2>
                                <p class="text-muted">Africa's fastest growing network of professionals</p>
                            </div>

                            <div class="col-sm-12">

                                <div class="white padbox rounded">


                                    <form role="form" class="form-signin" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}
                            
                            <div class="row">
                                <p class="text-center">Sign in with</p>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-linkedin btn-block"> <i class="fa fa-linkedin"></i> Linkedin</a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-facebook btn-block"> <i class="fa fa-facebook"></i> Facebook</a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                            <fieldset><legend>or</legend></fieldset>
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">Your Email</label>
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="">Your Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            </div>

                            <div class="row"><br>

                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-xs-12"><hr></div>

                                <div class="col-sm-6">
                                    <p class="text-center"><a href="">I can't remember my password!</a></p>
                                </div>

                                <div class="col-sm-6">
                                    <p class="text-center">Not registered? <a href="{{ url('sign-up') }}">Sign Up Here</a></p>
                                </div>

                            </div>
                        </form>

                                </div>
                                <!--/tab-content-->

                            </div>

                        </div>
                    </div>
                

            </section>
            </div>
        </div>
    </div>


    <!-- Signin Modal -->
    <div class="modal animated animated-fast slideInUp" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <section class="no-pad">

                
                    <div class=""><div class="text-center">
                        
                        <h2>Seamless Hiring</h2>
                        <p class="text-muted">Africa's fastest growing network of professionals</p>
                    </div>
                        <div class="white padbox rounded">


                        <form role="form" class="form-signup" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-linkedin btn-block"> <i class="fa fa-linkedin"></i> Sign up with Linkedin</a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-facebook btn-block"> <i class="fa fa-facebook"></i> Sign up with Facebook</a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                            <fieldset><legend>or use the form below</legend></fieldset>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name" value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="last_name" value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">Your Email</label>
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="">Create your Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="">Re-type Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            </div>

                            <div class="row">
                                <span class="hidden-xs"><br></span>
                                <div class="col-sm-6 text-muted">
                                    By clicking "Sign Up", you agree with our <a href="#">Terms & Conditions</a>
                                <span class="visible-xs"><br></span>
                                </div>

                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-sm-12">
                                    <hr>
                                </div>

                                <div class="col-xs-12 text-center">
                                    <p>Already registered? <a href="{{ url('log-in') }}">Sign In Here</a></p>
                                </div>

                            </div>
                        </form>

                    </div>
                    </div>
                

            </section>
            </div>
        </div>
    </div>

    <!-- CV Modal -->
    
        
    <!-- My Cart Invoice -->
    <div class="modal fade" tabindex="-1" id="myInvoice" role="dialog" aria-labelledby="myInvoice">
      <div class="modal-dialog">
        <div class="modal-content">

            <h3 class="text-center">Confirm your order</h3>


        <section class="no-pad" id='ContentAREA'>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded">
         
                            <div class="alert alert-info text-center">If you choose to make payment directly to our bank account by visiting a bank physically or via online transfer, do ensure to
                            send a mail to billing@insidify.com stating the details of your payment.
                            </div>

                            <div class="well">

                                <div class="col-xs-6">

                                    <strong>Invoiced To</strong><br>
                                    bunmifamiloni<br>familoni oluwatayo<br>
                                    mayfair, ile ife, Osun, 234, Nigeria

                                </div>
                                <div class="col-xs-6">

                                    <strong>Pay To</strong><br>
                                    Account Name: Insidify Limited<br>
                                    Account No: 0114023729<br>
                                    Bank: Guaranty Trust Bank (GTB)<br>
                                    OR<br>
                                    Account No: 1013173318<br>
                                    Bank: Zenith Bank<br>
                                    TIN: 12001705-0001
                                </div>
                                <div class="clearfix">
                                
                                </div>

                            </div>

                        
                        <div class="col-sm-12">
                        <br>
                        <div class="">
                            <span class="title">Invoice #80186</span><br>
                            Invoice Date: 11/09/2015<br>
                            Due Date: 25/09/2015
                        </div>

                            <br>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <thead class="title textcenter">
                                    <tr>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>Aspire (1GB) - lifeplanhospitalproject.com (25/09/2015 - 24/09/2016) *</td>
                                    <td class="textcenter">N3,000.00</td>
                                </tr>
                                <tr>
                                    <td>Domain Renewal - lifeplanhospitalproject.com - 1 Year/s (25/09/2015 - 24/09/2016) *</td>
                                    <td class="textcenter">N2,400.00</td>
                                </tr>
                                <tr>
                                    <td>Gateway Charge ( QuickTeller (Naira MasterCard/Verve)  + 3.63% )</td>
                                    <td class="textcenter">N196.02</td>
                                </tr>
                                <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">N5,338.88</td>
                                </tr>
                                    <tr class="title">
                                    <td class="text-right">5.00% VAT:</td>
                                    <td class="textcenter">N257.14</td>
                                </tr>
                                        <tr class="title">
                                    <td class="text-right">Credit:</td>
                                    <td class="textcenter">N0.00</td>
                                </tr>
                                <tr class="title">
                                    <td class="text-right">Total:</td>
                                    <td class="textcenter">N5,596.02</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                        
                        </div>
                    <!-- <a class="btn btn-line">Cancel Order</a> -->
                    <div class="col-sm-12 text-center">
                        <a href="payment-success.php" class="btn btn-success pull-right">Pay Now</a>
                        <div class="separator separator-small"></div>
                    </div>

                    </div>
                </div>
         </section>
        </div>
      </div>
    </div>

    
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
