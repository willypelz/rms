@extends('layout.template-default')


@section('navbar')
    
@show()

@section('content')
<style>
    
    body{
        background:url('{{ asset('img/intro-bg.jpg')  }}') no-repeat fixed ;
        background-size:cover;
    }

</style>

<!-- Main Content -->
<section>
<div class="container">
    <div class="row">
    <div class="col-sm-4 col-sm-offset-4 text-center">
                    <h2 class="text-brandon text-light"><img src="{{ url('/') }}/img/logomark.png" alt=""></h2>

                </div>



                
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="white padbox rounded">
                <div class="col-sm-12">
                                <p class="text-center">Choose Password</p>
                                <p class="text-left"><small>Please choose password you will use to sign in to your seamless hiring account</small></p>
                                <br/>
                            </div>

                

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} hidden">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="email" value="{{ $email or old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('footer')
        
@endsection
