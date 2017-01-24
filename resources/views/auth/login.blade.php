

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
                    <h2 class=""><img src="{{ url('/') }}/img/seamlesshiring-logo-x.png" width="150px" alt=""></h2><br>    
                    <!-- <p class="">Everything You Need To Hire, In One Place!</p> -->
                </div>

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

                    <div class="white padbox rounded">
                        
                        @include('layout.alerts')

                        <form role="form" class="form-signin" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}
                            
                            <div class="row">
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

                                <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                                    <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-left"><a href="{{ url('password/reset') }}">:( I can't remember my password!</a></p>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-right">Not registered? <a href="{{ url('sign-up') }}">Sign Up Here</a></p>
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