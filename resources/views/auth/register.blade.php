@extends('layout.template-default')


@section('navbar')
    
@show()

@section('content')

<script src="{{ asset('js/jquery.slugify.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript" charset="utf-8">
            $().ready(function () {
                $('.slug').slugify('#company_name');
            
                var pigLatin = function(str) {
                    return str.replace(/(\w*)([aeiou]\w*)/g, "$2$1ay");
                }
            
                $('#pig_latin').slugify('#company_name', {
                        slugFunc: function(str, originalFunc) { return pigLatin(originalFunc(str)); } 
                    }
                );
            
            }); 
</script>

<style type="text/css">
    .error{
        color:red;
    }
</style>

<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Seamless Hiring</h2>
                    <p class="text-muted">Africa's fastest growing network of professionals</p>
                </div>

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                    <div class="white padbox rounded">


                        <!-- <form role="form" class="form-signup" method="POST" action="{{ route('registration') }}" type='file'> -->
                              {!! Form::open(array('route'=>'registration','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

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
                            <fieldset><legend>or use the form below</legend></fieldset><br>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name" value="{{ old('first_name') }}" required>
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
                                        <input type="text" class="form-control" id="" placeholder="" name="last_name" value="{{ old('last_name') }}" required>
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
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="{{ old('email') }}" required>
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
                                    <input type="password" class="form-control" id="password" placeholder="" name="password" required>

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
                                    <input type="password" class="form-control" id="confirm_password" placeholder="" name="confirm_password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <hr>
                            <br>
                            <legend>Company Information</legend>
                            <br>
                            

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="">Company name</label>
                                        <input type="text" class="form-control" id="company_name" placeholder="" name="company_name" value="{{ old('company_name') }}" required>
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label for="">Slug</label>
                                        <input type="text" class="form-control slug" id="" placeholder="" name="slug" value="{{ old('slug') }}" required>
                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                                        <label for="">Company Email</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="company_email" value="{{ old('company_email') }}" required>
                                        @if ($errors->has('company_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="phone" value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="website" value="{{ old('website') }}" required>
                                        @if ($errors->has('website'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                

                                 <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="10" required></textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                        <label for="">About Company</label>
                                        <textarea name="about_company" class="form-control" id="" cols="30" rows="10" required></textarea>
                                        @if ($errors->has('about_company'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('about_company') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                        <label for="">Company Logo</label>
                                <?php  echo Form::file('logo'); ?>
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
                                    <button type="submit" class="btn btn-success btn-block">Sign Up &raquo;</button>
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

    <script>
        $("#SignUPform").validate({
            rules:{
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            }
        });
    </script>
@endsection

@section('footer')
        
@endsection