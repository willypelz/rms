@extends('layout.template-guest')


@section('navbar')
    
@show()

@section('content')
<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Seamless Hiring</h2>
                    <p class="text-muted">Africa's fastest growing network of professionals</p>
                </div>

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

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
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Your Email</label>
                                    <input type="email" class="form-control" id="" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Create your Password</label>
                                    <input type="password" class="form-control" id="" placeholder="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Re-type Password</label>
                                    <input type="password" class="form-control" id="" placeholder="">
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
                                    <button type="submit" class="btn btn-default btn-block">Proceed &raquo;</button>
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
                    <!--/tab-content-->

                </div>

            </div>
        </div>
    </section>
@endsection

 @section('footer')
        
@show()