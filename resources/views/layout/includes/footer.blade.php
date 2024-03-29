<script src="{{ secure_asset('js/jquery.form.js') }}"></script>

<script>
    $(document).ready(function () {

        //--------Homepage Sticky header----------//

        //updateLink();

        $('#sticky-header ul li a').on('click', function () {
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

        $('.btn-cv-buy').on('click', function (e) {

            console.log('Using thuis')

            cart_count = Number(cart_count) + 1;
            p_total = 500 * cart_count;

            e.preventDefault();
            $(this).parents('.purchase-action').find('.btn-cv-discard').removeClass('collapse');
            $(this).addClass('collapse');
            $('#collapseWellCart').removeClass('collapse');
            $(".btn-cart-checkout").removeClass("disabled");

            $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>' + cart_count + '</b></span>');
            $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>' + p_total + '</b></span>');

        });


        //--------Remove item from Cart--------//
        $('.btn-cv-discard').on('click', function (e) {

            console.log('cart count is ' + cart_count);

            cart_count = Number(cart_count) - 1;
            p_total = 500 * cart_count;

            e.preventDefault();
            $(this).parents('.purchase-action').find('.btn-cv-buy').removeClass('collapse');
            $(this).addClass('collapse');

            $('#item-count').html('<span class="animated zoomIn fa-2x" style="display: inline-block; color:#333"><b>' + cart_count + '</b></span>');
            $('#price-total').html('<span class="animated zoomIn" style="display: inline-block; color:#333"><b>' + p_total + '</b></span>');

            if (p_total == 0) {
                // $(".btn-cart-checkout").addClass("disabled");

                return p_total;
            }

        });


        $("#owl-posts").owlCarousel({
            navigation: true,
            items: 4,
            responsive: false,
            scrollPerPage: false,
            pagination: true,
            autoPlay: false,
            navigationText: [
                "<span class='fa fa-chevron-left'></span>",
                "<span class='fa fa-chevron-right'></span>"
            ],

        });

        $("#owl-posts2").owlCarousel({
            navigation: true,
            items: 3,
            responsive: false,
            scrollPerPage: false,
            pagination: true,
            autoPlay: false,
            navigationText: [
                "<span class='fa fa-chevron-left'></span>",
                "<span class='fa fa-chevron-right'></span>"
            ],

        });

    });
</script>

<footer id="app-footer">
    <div class="container">

        <div class="row">

            <div class="col-md-3 hidden">
                <h5>Find us on Social Media.</h5>

                <a href="https://www.facebook.com/insidifyhq?ref=hl&ref_type=bookmark" class="">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-" style="color:#3b5998"></i>
                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                    </span>
                </a>

                <a href="https://twitter.com/insidifyhq" class="">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-" style="color:#0084b4"></i>
                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </a>

                <a href="https://www.linkedin.com/company/insidify-com?trk=biz-companies-cym" class="">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </div>

            <div class="col-sm-6 hidden">
                <div class="col-sm-4">
                    <ul class="list-unstyled">
                        <li>
                            <h5>Employer?</h5>
                        </li>
                        <li><a href="{{ route('post-job') }}">Post a job</a>
                        </li>
                        <li><a href="{{ url('cv/search') }}">Find a talent</a>
                        </li>
                        <li><a href="{{ url('about') }}">About SeamlessHiring</a>
                        </li>
                        <li><a href="{{--{{ route('pricing-page') }}--}}">Pricing</a>
                        </li>
                        <li class=""><a class="" href="{{ url('talentSource') }}">Talent Sourcing </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-4">
                    <ul class="list-unstyled">
                        <li>
                            <h5>Jobseeker?</h5>
                        </li>
                        <li><a href="http://insidify.com">Insidify.com</a>
                        </li>
                        <li><a href="http://insidify.com/about_us">About Insidify.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-4">
                    <ul class="list-unstyled">
                        <li>
                            <h5>Contact</h5>
                        </li>
                        <li><a href="{{ url('contact') }}">Contact Us</a>
                        </li>
                        <li><a href="{{ url('faq') }}">FAQ page</a>
                        </li>
                        <li><a href="{{ url('terms') }}">Terms and Conditions</a>
                        </li>
                        <li><a href="{{ url('privacy') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 text-center">
                <ul class="list-unstyled footer-logo">
                    <li>
                        {{--<img src="{{env('SEAMLESS_HIRING_LOGO_WHITE')}}" alt="" width="185px"><br>--}}
                        <small class="text-white">&copy; {{date('Y')}}. All Rights Reserved. Read our <a href="https://seamlesshr.com/privacy-security/">privacy policy</a></small>
                    </li>
                </ul>
            </div>
        </div>


    </div>
</footer>


<!-- Login Modal -->
<div class="modal animated animated-fast slideInUp" id="loginModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <section class="no-pad">


                <div class="">
                    <div class="row" id="content-Area">

                        <div class="col-sm-12 text-center">
                            <h2>SeamlessHiring</h2>
                            <p class="text-muted">Everything You Need To Hire, In One Place!</p>
                        </div>

                        <div class="col-sm-12">

                            <div class="white padbox rounded">

                                <div id="mssg"></div>

                                <form role="form" id="AjaxLogin" class="form-signin" method="POST"
                                      action="{{ route('ajax_login') }}">
                                    {!! csrf_field() !!}

                                
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group{{ isset($errors) && @$errors->has('email') ? ' has-error' : '' }}">
                                                <label for="">Your Email</label>
                                                <input type="email" class="form-control" id="" placeholder=""
                                                       name="email" value="{{ old('email') }}" required>

                                                @if (isset($errors) && @$errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ isset($errors) ? @$errors->first('email') : null }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ isset($errors) && @$errors->has('password') ? ' has-error' : '' }}">
                                                <label for="">Your Password</label>
                                                <input type="password" class="form-control" id="" placeholder=""
                                                       name="password" required>
                                                @if (isset($errors) && @$errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ isset($errors) ? @$errors->first('password') : null }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row"><br>

                                        <div class="col-sm-10 col-sm-offset-1">
                                            <button type="submit" id="SubBtn" class="btn btn-success btn-block">Proceed
                                                &raquo;
                                            </button>
                                        </div>

                                        <div class="col-xs-12">
                                            <hr>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="text-center"><a href="{{ url('password/reset') }}">I can't
                                                    remember my password!</a></p>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="text-center">Not registered? <a href="{{ url('sign-up') }}">Sign
                                                    Up Here</a></p>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!--/tab-content-->

                        </div>

                    </div>
                </div>

                <script>
                    $(document).ready(function () {

                        // console.log("{{ asset('img/loader-logo-32.gif') }}")

                        $('#AjaxLogin').ajaxForm({
                            beforeSubmit: genPreSubmit,
                            success: function (response) {
                                if (response == 'Failed') {
                                    $('#mssg').html("<span class='alert alert-danger' > Your login credentials are incorrect. </span>");
                                    $("#SubBtn").html('Proceed');

                                } else {
                                    // $('#mssg').html("<span class='alert alert-success' > Logged in successfully. </span>")
                                    $("#SubBtn").html('Logging you in');
                                    $("#content-Area").html('{!! preloader() !!}');

                                    setTimeout(function () {
                                        window.location = "{{ url('dashboard') }}";
                                    }, 3000);
                                }

                            },
                            reset: true
                        });

                        function genPreSubmit() {
                            $("#SubBtn").html('please wait...');

                        }


                    });


                </script>


            </section>
        </div>
    </div>
</div>


<!-- Signin Modal -->
<div class="modal animated animated-fast slideInUp" id="SignupModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <section class="no-pad">


                <div class="">
                    <div class="text-center">

                        <h2>SeamlessHiring</h2>
                        <p class="text-muted">Africa's fastest growing network of professionals</p>
                    </div>
                    <div class="white padbox rounded">


                        <form role="form" class="form-signup" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group{{ isset($errors) && @$errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name"
                                               value="{{ old('first_name') }}">
                                        @if (isset($errors) && @$errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ isset($errors) ? @$errors->first('first_name') : null }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ isset($errors) && @$errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="last_name"
                                               value="{{ old('last_name') }}">
                                        @if (isset($errors) && @$errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ isset($errors) ? @$errors->first('last_name') : null}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ isset($errors) && @$errors->has('email') ? ' has-error' : '' }}">
                                        <label for="">Your Email</label>
                                        <input type="email" class="form-control" id="" placeholder="" name="email"
                                               value="{{ old('email') }}">
                                        @if (isset($errors) && @$errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ isset($errors) ? @$errors->first('email') : null }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ isset($errors) && @$errors->has('password') ? ' has-error' : '' }}">
                                        <label for="">Create your Password</label>
                                        <input type="password" class="form-control" id="" placeholder=""
                                               name="password">

                                        @if (isset($errors) && @$errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ isset($errors) ? @$errors->first('password') : null }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ isset($errors) && @$errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="">Re-type Password</label>
                                        <input type="password" class="form-control" id="" placeholder=""
                                               name="password_confirmation">
                                        @if (isset($errors) && @$errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ isset($errors) ? @$errors->first('password_confirmation') : null }}</strong>
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

                                <div class="alert alert-info text-center">If you choose to make payment directly to our
                                    bank account by visiting a bank physically or via online transfer, do ensure to
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
                                            <td>Aspire (1GB) - lifeplanhospitalproject.com (25/09/2015 - 24/09/2016) *
                                            </td>
                                            <td class="textcenter">N3,000.00</td>
                                        </tr>
                                        <tr>
                                            <td>Domain Renewal - lifeplanhospitalproject.com - 1 Year/s (25/09/2015 -
                                                24/09/2016) *
                                            </td>
                                            <td class="textcenter">N2,400.00</td>
                                        </tr>
                                        <tr>
                                            <td>Gateway Charge ( QuickTeller (Naira MasterCard/Verve) + 3.63% )</td>
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


<!-- modals -->
<div class="modal fade no-border" id="cvModal" role="dialog" aria-labelledby="cvViewModalLabel" aria-hidden="false">
    <div id="cvModalContent">


    </div>
</div>

@include('modals.template')


<script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ secure_asset('js/script.js') }}"></script> -->
{{--<script src="{{ secure_asset('js/owl.carousel.js') }}"></script>--}}
<script src="https://cdn.insidify.com/dist/js/owl.carousel.min.js"></script>
<script src="{{ secure_asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ secure_asset('js/select2.min.js') }}"></script>
<script src="{{ secure_asset('js/jquery.growl.js') }}"></script>

<script type="text/javascript">
    $(window).scroll(function () {

        var targ = $("#target-stick");
        var cart = $(".well-cart");

        if (targ.offset().top > 100) {

            // animating navbar background
            // body.addClass("fold");

            //Fix or release Cart
            cart.addClass("fixer");
        } else {

            // animating navbar background
            // body.removeClass("fold");

            //Fix or release Cart
            cart.removeClass("fixer");
        }
    });


    if (!sh)
        var sh = window.sh = {};

    sh.showModal = function (obj, title, view, data) {
        $('#viewModal .modal-title').text(title);
        $('.modal-dialog').removeClass('modal').removeClass('modal-lg').addClass(data.modal_size);

        // $user = $(this).closest('.media');
        // var $user = obj.closest('.media').clone();
        // $user.find('input[type="checkbox"]').remove();
        // $user.find('small').remove();
        // data.badge = $user.html();

        $.get(view, data, function (response) {
            $('#viewModal .modal-body').html(response);

        });
    }


    sh.showWideModal = function () {

    }

    $(document).ready(function () {

        $('.modal-header .close');

        $('body').on('click', '#modalButton', function () {

            var data = {
                app_id: $(this).attr('data-app-id'),
                cv_id: $(this).attr('data-cv')
            }

            if ($(this).attr('data-type') == 'normal') {
                data.modal_size = 'modal-md';
                sh.showModal($(this), $(this).attr('data-title'), $(this).attr('data-view'), data);
            } else if ($(this).attr('data-type') == 'wide') {
                data.modal_size = 'modal-lg';
                sh.showModal($(this), $(this).attr('data-title'), $(this).attr('data-view'), data);
            } else if ($(this).attr('data-type') == 'small') {
                data.modal_size = 'modal-sm';
                sh.showModal($(this), $(this).attr('data-title'), $(this).attr('data-view'), data);
            }
        });

        $('#viewModal').on('hidden.bs.modal', function () {
            $('#viewModal .modal-title').text("Default Text");
            $('#viewModal .modal-body').html(window.preloader);
            console.log("Modal has been closed");
        });

        // onclick="sh.showModal('Assess','')"
    });
</script>


<script>

    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        startDate: today

    });

    $('.select2').select2();


    function showCvModal(cv_id, is_applicant, appl_id) {

        $("#cvModalContent").html('{!! preloader() !!}');
        // $("#cvModalContent").modal('show');

        $.ajax
        ({
            type: "POST",
            url: "{{ route('cv-preview') }}",
            data: ({rnd: Math.random() * 100000, cv_id: cv_id, is_applicant: is_applicant, appl_id: appl_id}),
            success: function (response) {
                $("#cvModalContent").html(response);

            }
        });


        return false;


    }


    function scrollTo(target) {
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 2000);
    }


</script>

<script src="{{ secure_asset('js/update-october-2018.js') }}"></script>
