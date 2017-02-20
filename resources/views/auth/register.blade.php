@extends('layout.template-default')


@section('navbar')
    
@show()

@section('content')

<script src="{{ asset('js/jquery.slugify.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">


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
    body{
        background:url('img/intro-bg.jpg') no-repeat fixed ;
        background-size:cover;
    }
</style>

<section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 text-center text-white">
                <div class="separator separator-small"><br></div>
                    <h2 class="">Sign Up here 
                    <!-- <img src="{{ url('/') }}/img/seamlesshiring-logo-x.png" alt=""> -->
                    </h2> 
                    <p class="">Kindly provide all information where necessary</p><br>
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    <div class="white padbox rounded">


                        <!-- <form role="form" class="form-signup" method="POST" action="{{ route('registration') }}" type='file'> -->
                              {!! Form::open(array('route'=>'registration','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

                            {!! csrf_field() !!}

                            <div class="row">
                            

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name" value="{{ old('first_name') }}" required>
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                        <small class="text-muted">&uarr; Short descriptive text comes here.</small>
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
                            <br style="clear: both;"><br style="clear: both;">

                            
                            <fieldset class="text-center"><legend>Company Information</legend></fieldset>
                            
                            

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="">Company name</label>
                                        <input type="text" class="form-control" id="company_name" placeholder="" name="company_name" value="{{ old('company_name') }}" required>
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                        <small class="text-muted">&uarr; Short descriptive text comes here.</small>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label for="">Company url</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">http://</span>
                                            <input type="text" class="form-control slug" id="" placeholder="" name="slug" value="{{ old('slug') }}" required>
                                            <span class="input-group-addon">.seamlesshiring.com</span>
                                        </div>

                                            <small class="text-muted">&uarr; e.g. http://jumia.seamlesshiring.com</small>

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
                                        <small class="text-muted">&uarr; Short descriptive text comes here.</small>

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

                                 <div class="col-sm-12">
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
                                        <textarea name="address" class="form-control" id="" cols="30" rows="10" required>   {{ old('address') }} </textarea>
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
                                        <textarea name="about_company" class="form-control" id="" cols="30" rows="10" required>{{ old('about_company') }}</textarea>
                                        @if ($errors->has('about_company'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('about_company') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }} text-center">
                                        <label class="col-md-12" for="">Company Logo</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                              <div>
                                                <span class="btn btn-line btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                 <?php  echo Form::file('logo'); ?>
                                                </span>
                                                <a href="#" class="btn btn-line fileinput-exists" data-dismiss="fileinput">Remove</a>
                                              </div>
                                            </div>


                                    </div>
                                </div>

                                
                            


                            </div>

                            <div class="row">
                                <span class="hidden-xs"><br></span>
                                <div class="col-sm-6 text-muted">
                                    By clicking "Sign Up", you agree with our <a href="{{ url('terms') }}">Terms & Conditions</a>
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

                    <div class="separator separator-small text-center text-muted">
                        <p class="small">&copy; {{ date('Y') }}. SeamlessHiring. All Rights Reserved</p>
                    </div>

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
            },
            messages: {
                confirm_password: {
                    equalTo: "Passwords do not match"
                }
            }
        });
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

@endsection

@section('footer')
        
@endsection