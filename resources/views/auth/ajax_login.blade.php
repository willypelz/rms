        <div class="container">
            <div class="row">

               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

                    <div class="white padbox rounded">


                        <form role="form" id="AjaxSignin" class="form-signin" method="POST" action="">
                            {!! csrf_field() !!}
                            
                            <div class="row">
                                <p class="text-center">Sign in with</p>
                                <div id="error" style="color:red"></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-linkedin btn-block"> <i class="fa fa-linkedin"></i> Linkedin</a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-facebook btn-block"> <i class="fa fa-facebook"></i> Facebook</a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                            <fieldset><legend>or</legend></fieldset>
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="">Your Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" required>

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
                                    <input type="password" class="form-control" id="password" placeholder="" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            </div>

                            <div class="row"><br>
                            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

                                <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                                    <button type="submit" id="loginBTN" class="btn btn-success btn-block">Login &raquo;</button>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-left"><a href="{{ url('password/reset') }}">:( I can't remember my password!</a></p>
                                </div>

                                <div class="col-sm-6"><br>
                                    <p class="small text-right">Not registered? <a href="{{ url('sign-up') }}">Sign Up Here</a></p>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!--/tab-content-->

                </div>

            </div>
        </div>
            <script>
               $('#loginBTN').click(function(){
                // console.log('{{ asset("img/ajaxloader.gif") }}')

                                var url = "{{ route('ajax_login') }}";
                                var email = $('#email').val()
                                var password = $('#password').val()
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, "_token":"{{ csrf_token() }}", email:email, password:password}),
                                        success: function(response){
                                          // console.log(response);
                                          if(response == 'Failed'){
                                            $('#error').text('Details do not match our records');
                                          }else{
                                                 var urll = "{{ route('ajax_checkout') }}";

                                                  $.ajax
                                                  ({
                                                    type: "POST",
                                                    url: urll,
                                                    data: ({ rnd : Math.random() * 100000, "_token":"{{ csrf_token() }}"}),
                                                    success: function(response){
                                                      // console.log(response);
                                                      $('#invoice-res').html(response)
                                                      
                                                    }
                                                });
                                          }

                                        }
                                    });

                return false;
                
            })
            </script>
