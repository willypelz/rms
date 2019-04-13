

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
                    <h2 class=""><img src="http://seamlesshiring.com/img/seamlesshiring-logo-white.png" width="190px" alt=""></h2><br>    
                    <!-- <p class="">Everything You Need To Hire, In One Place!</p> -->
                </div>

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

                    <div class="white padbox rounded">
                        
                        @include('layout.alerts')

                        <form role="form" class="form-signin" method="POST">
                            {!! csrf_field() !!}
                            
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">Your Email</label>
                                    <input type="email" required="" class="form-control" placeholder="" id="email" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12" style="display: none" id="passwordField">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="">Your Password</label>
                                    <input type="password" required="" class="form-control" id="" placeholder="" name="password">
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
                                    <button type="submit" id="submitLoginButton" onclick="checkUserDetails();return false" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-left"><a href="@if(env('USE_ACTIVE_DIRECTORY') == 1) {{env('STAFFSTRENGTH_URL') . 'forgot-password'}} @else {{ url('password/reset') }} @endif">:( I can't remember my password!</a></p>
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


<script type="text/javascript">
    function checkUserDetails() {
        var email = $('#email').val();


        if(email.length < 1){
            $('#error').html('Please enter your email');
            $('#error').show();
            return false;
        }


        $.ajax({ url:"{{ route('verify-user-details') }}",
                data:{email:email, _token:"{{ csrf_token() }}"},
                type:'POST', success:function(res){
                    if(res.status == 200){

                        if(res.is_external == true){
                            // Show Password field
                            $('#passwordField').show();
                            $("#submitLoginButton").prop("onclick", null).off("click");
                        }else{

                            window.location = res.redirect_url;
                        }

                    }else{

                        
                        setTimeout(function(){ 
                            $('#error').html(res.message);
                            $('#error').show();
                         }, 3000);

                    }
                } 
            });

    }
</script>

@section('footer')
    
@show()