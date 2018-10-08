

@extends('layout.template-default')

@section('navbar')
    
@show()
@section('content')

<style>
    
    body{
        background:url('img/intro-bg.jpg') no-repeat fixed ;
        background-size:cover;
    }

</style>
<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 text-center text-white">
                    <h2 class=""><img src="https://cdn.insidify.com/dist/img/logos/seamlesshiring-white.svg" width="190px" alt=""></h2><br>    
                    <!-- <p class="">Everything You Need To Hire, In One Place!</p> -->
                </div>

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <h2 class="text-center">Candidate Register</h2>
                    <div class="white padbox rounded">
                        
                        @include('layout.alerts')

                        <form role="form" class="form-signin" method="POST" action="{{ route('candidate-register') }}">
                            {!! csrf_field() !!}
                            
                            <div class="row">
                                <input type="hidden" name="redirect_to" value="{{ $redirect_to }}" />

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="">Firstname</label>
                                    <input type="first_name" class="form-control" id="" placeholder="" name="first_name" value="{{ old('first_name') }}" required>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="">Lastname</label>
                                    <input type="last_name" class="form-control" id="" placeholder="" name="last_name" value="{{ old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            </div>

                            <div class="row"><br>

                                <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                                    <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-left"><a href="{{ route('candidate-forgot', ['redirect_to' => $redirect_to]) }}">:( I can't remember my password!</a></p>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-right">Registered? <a href="{{ route('candidate-login', ['redirect_to' => $redirect_to]) }}">Login</a></p>
                                </div>

                            </div>
                        </form>


                    </div><br>

                        <p class="text-center"><small class="text-white">&copy; {{ date('Y') }}. All Rights Reserved. SeamlessHiring <br> Insidify Enterprise by Insidify.com</small></p>
                    <!--/tab-content-->

                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer')
    
@show()