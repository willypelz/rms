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

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Add New Company</h2>
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    <div class="white padbox rounded">


                        <!-- <form role="form" class="form-signup" method="POST" action="{{ route('registration') }}" type='file'> -->
                              {!! Form::open(array('route'=>'add-company','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

                            {!! csrf_field() !!}

                            <div class="row">

                                <div class="col-sm-6 col-sm-offset-3 text-center">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                        <label class="col-md-12" for="">Company Logo</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                              <div>
                                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                 <?php  echo Form::file('logo'); ?>
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                              </div>
                                            </div>


                                    </div>
                                </div>
                        
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

                                {{-- <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label for="">Company url</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">http://</span>
                                            <input type="text" class="form-control slug" id="" placeholder="" name="slug" value="{{ old('slug') }}" required>
                                            <span class="input-group-addon">.seamlesshiring.com</span>
                                        </div>
                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
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

                                 <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="website" value="{{ @$client->url ?? old('website') }}" readonly>
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
                                
                            

                            </div>

                            <div class="row">

                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add</button>
                                </div>

                               

                            </div>
                        </form>

                    </div>
                    <!--/tab-content-->

                    <div class="separator separator-small text-center text-muted">
                        <p class="small">&copy; 2016. SeamlessHiring. All Rights Reserved</p>
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
            }
        });
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

@endsection

@section('footer')
        
@endsection