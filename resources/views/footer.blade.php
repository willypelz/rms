
    <footer>
        <div class="container">

            <div class="row">

                <div class="col-sm-3">
                    <ul class="list-unstyled footer-logo">
                        <li>
                            <h4 class="text-brandon" style="text-transform: capitalize;"><img src="../img/logomark2.png" alt=""></h4>
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
                   <h5>Find us on Social Media.</h5>
               
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
                                <h2>SeamlessHiring</h2>
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

                                

                                <div class="col-sm-6"><br>
                                    <p><a href="">:( I can't remember my password!</a></p>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p>Not registered? <a href="{{ url('sign-up') }}">Sign Up Here</a></p>
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


    <!-- Signup Modal -->
    <div class="modal animated animated-fast slideInUp" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <section class="no-pad">

                
                    <div class=""><div class="text-center">
                        
                        <h2>SeamlessHiring</h2>
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
    <div class="modal fade no-border" id="cvViewModal" tabindex="-1" role="dialog" aria-labelledby="cvViewModalLabel" aria-hidden="false">
            <div class="">
            <div class="container">

                <div class="row">

            <div class="col-xs-10 col-xs-offset-1 view">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<br>
                <div class="row">
                    <div class="col-xs-5">
                        
                          <p class="">
                                <!-- Single button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Save into Folder &nbsp; <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                <li role="separator" class="divider"></li>

                                <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                              </ul>
                            </div>


                                          <span class="purchase-action hidden">
                                                <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                              <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                        </span>
                          </p>
                    </div>

                    <div class="col-xs-2">
                        <div class="text-center cv-portrait">
                            <img src="{{ asset('img/brand-img.jpg') }}" class="img-circle">
                        </di) v>
                    </div>

                    <div class="col-xs-5">
                    </div>
                </div>

                <div class="tab-content stack" id="cv">

                    <div class="row">
                        <div class="col-xs-12 cv-name text-center">
                            <h2>Ernest Ojeh</h2>
                            <p class="text-muted">Designer &amp; Something else at <a href="#">Google Inc.</a>
                            </p>
                            <hr>
                        </div>
                    </div>

                    <div class="unit-box">
                        <div class="row">
                            <div class="col-xs-1 r-left">
                                <span class="glyphicon glyphicon-file"></span>
                            </div>
                            <div class="col-xs-11">
                                <h5>PERSONAL INFO</h5>
                                <p class="text-muted">Medical Doctor, Entrepreneur, Passionate about change and excellence</p>
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Sex:</strong>&nbsp; Male</li>
                                    <li>
                                        <strong>Email:</strong>&nbsp; emmanuel@insidify.com</li>
                                    <li>
                                        <strong>Phone:</strong>&nbsp; 08068873719</li>
                                    <li>
                                        <strong>Age:</strong>&nbsp; 27 years old
                                        <span class="text-muted">(Oct 01, 1987)</span>
                                    </li>
                                    <li>
                                        <strong>Address:</strong>&nbsp; Magodo GRA, Lagos.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="unit-box">
                        <div class="row">
                            <div class="col-xs-1 r-left">
                                <span class="glyphicon glyphicon-wrench"></span>
                            </div>
                            <div class="col-xs-11">
                                <h5>SKILLS</h5>
                                <p class="text-muted">Medical Doctor, Entrepreneur, Public Speaker</p>
                            </div>
                        </div>
                    </div>

                    <div class="unit-box">
                        <div class="row">
                            <div class="col-xs-1 r-left">
                                <span class="glyphicon glyphicon-briefcase"></span>
                            </div>
                            <div class="col-xs-11">
                                <h5>WORK EXPERIENCE</h5>

                                <div class="sub-box">
                                    <p class="text-muted">May 2013 - present</p>
                                    <h5>Co-founder and CEO at <a href="#">Insidify.com</a>
                                    </h5>
                                    <p>Lagos, Nigeria</p>
                                </div>

                                <div class="sub-box">
                                    <p class="text-muted">Apr 2012 - Apr 2013</p>
                                    <h5>House Physician at <a href="#">St. Nicholas Hospital Lagos</a>
                                    </h5>
                                    <p>Lagos, Nigeria</p>
                                </div>

                                <div class="sub-box">
                                    <p class="text-muted">Dec 2007 - present</p>
                                    <h5>Head Business Development at <a href="#">Waressence</a>
                                    </h5>
                                    <p>Lagos, Nigeria</p>
                                </div>

                                <div class="sub-box">
                                    <p class="text-muted">Dec 1999 - present</p>
                                    <h5>Curator at <a href="#">Employment Edge</a>
                                    </h5>
                                    <p>Lagos, Nigeria</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="unit-box">
                        <div class="row">
                            <div class="col-xs-1 r-left">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </div>
                            <div class="col-xs-11">
                                <h5>EDUCATION</h5>

                                <div class="sub-box">
                                    <p class="text-muted">Aug 2003 - Aug 2011</p>
                                    <h5>Medicine and Surgery at Obafemi Awolowo University</h5>
                                    <p>M.B.ch.B, Pass</p>
                                </div>

                                <div class="sub-box">
                                    <p class="text-muted">Jan 1970 - Dec 2003</p>
                                    <h5>Hallmark Secondary School</h5>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="unit-box">
                        <div class="row">
                            <div class="col-xs-1 r-left">
                                <span class="glyphicon glyphicon-link"></span>
                            </div>
                            <div class="col-xs-11">
                                <h5>LINKS</h5>
                                <ul class="list-unstyled">
                                    <li><a href="http://www.facebook.com/olamide.okeleji">http://www.facebook.com/olamide.okeleji</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <!--/tab-content-->

            </div>


            </div>
            </div>
            </div>
        </div>
        
    <!-- My Cart Invoice -->
    <div class="modal fade" tabindex="-1" id="myInvoice" role="dialog" aria-labelledby="myInvoice">
      <div class="modal-dialog">
        <div class="modal-content">

            <h3 class="text-center">Confirm your order</h3>


        <section class="no-pad">
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

    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script type="text/javascript">
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
    </script>
