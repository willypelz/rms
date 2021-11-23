@extends('layout.template-default')


@section('navbar')

@show()

@section('content')
    <style>
        
        body {
            background: url('../img/intro-bg.jpg') no-repeat fixed;
            background-size: cover;
        }
    
    </style>
    
    <!-- Main Content -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 text-center text-white">
                    <h2 class="">
                        <img src="{{getEnvData('SEAMLESS_HIRING_LOGO_WHITE',null,request()->clientId)}}" width="190px" alt="">
                    </h2><br>
                    <!-- <p class="">Everything You Need To Hire, In One Place!</p> -->
                </div>
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    
                    <div class="white padbox rounded">
                        
                        
                        <form role="form" class="form-signin" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            
                            <div class="row">
                                @include('layout.alerts')
                                <div class="col-sm-12">
                                    <p class="text-center">Forgot Password?</p>
                                    <p class="text-left">
                                        <small>Please re-enter your email address below and we’ll send you a password
                                            reset email.
                                        </small>
                                    </p>
                                </div>
                                
                                
                                <div class="">
                                    <div class="col-sm-12">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="">Your Email</label>
                                            <input type="email" class="form-control" id="" placeholder="" name="email"
                                                   value="{{ old('email') }}">
                                            
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                
                                
                                </div>
                                
                                <div class=""><br>
                                    
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block">Send Password Reset Link
                                            &raquo;
                                        </button>
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

@endsection