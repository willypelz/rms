@extends('layout.template-default')


@section('content')
<style>
.btn.btn-primary, section.s-div{
    background-color: #10588A
    }
    </style>

  <section class="s-div homepage">
        <div class="container">

            <div class="row text-center text-light text-white"><br>
                <h1> Sign Up</h1>
                <h1 class="lead">Create your SeamlessHiring Account in simple steps</h1>
            </div>

        </div>
    </section>


 <section class="white account-setup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="">
                        <br>
                        <div class="pagehead">
                            <form method="post" action="" id="signup_form">
                                {{ csrf_field() }}
                                    <div class="col-xs-2">
                                        </div>
                                <div class="col-xs-8 contact">
                                  @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                        {{Session::get('flash_message')}}<br>
                                    </div>
                                     @endif
                        
                                    <div class="clearfix">

                                        <span class="col-xs-12">
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Full Name </label><span class="text-danger">*</span>
                                                    <br>
                                                    <input type="text" name="name" class="form-control" placeholder="Your first name and last name">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label> Work Email </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="email" name="email" class="form-control" placeholder="Only a valid work email is allowed">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">    
                                                <div class="form-group">
                                                    <label>Company Name </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="text" name="company_name" class="form-control" placeholder="Name of your organisation">
                                                </div>
                                             </span>
                                            
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Phone Number </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="text" name="phone" class="form-control" placeholder="Your phone number">
                                                </div>
                                             </span>
                                             <div class="form-group col-xs-12">
                                                   
                                                    <label for="">Preferred url</label>  <span class="text-danger">*</span>
                                                    <div class="row">
                                                        <div class="col-xs-9">
                                                            <input type="text" name="domain" id="domain" class="form-control angular" placeholder="Enter your company name only" required></div>
                                                        <div class="col-xs-3">
                                                            <b class="btn btn-warning" style="margin-top:0px; height:42px; margin-left:-30px; padding-top:10px;">.seamlesshiring.com</b>
                                                        </div>
                                                    </div>
                                                    <div id="domain" class="text-danger"></div>
                                                    <div id="domainName" class="text-info"></div>
                                                </div>
                                             
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Password </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Preferred password">
                                                </div>
                                             </span>
                                        

                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Confirm Password </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Re-enter password">
                                                </div>
                                             </span>
                                            
                                            <span class="col-xs-12 text-center">
                                                <input type="checkbox" name="tos" id="tos" class="angular tos">
                                                 I agree to the SeamlesssHR <a href="https://seamlesshr.com/terms/">Terms of Service</a> and <a href="https://seamlesshr.com/privacy-security/">Privacy Policy</a></span>
                                            <br>
                                            
                                            <br>
                                            <span class="col-xs-12">
                                             <button id="submitButton"  type="submit" value="" class="btn btn-primary btn-block" disabled>   <i id="hide-spinner" class="fa fa-spinner fa-pulse" style="font-size:19px; color:white; display:none"></i>Create My Account
                                            </span>
                                        </span>                                            

                                           
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    </div>
                            </form>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="white hidden account-success">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                            <div class="alert alert-success">
                                    <p>Account created successfully, please check your email for instruction on the next steps. </p>
                            </div>
                    </div>
                </div>
            </div>
    </section>

<section class="s-div dark no-margin">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12">
        <p class="lead text-brandon text-white">Recruitment Made Unbelievably Easy.</p>
        {{-- <a href="{{ url('register') }}" class="btn btn-danger btn-lg"> Get Started</a> --}}
      </div>
    </div><div class="clearfix"><br></div>
  </div>
</section>
<script>
        $(document).ready(function () {
    
            $('#domain').keyup(function () {
                if ($(this).val().length > 0) {
                    $('#domainName').text('https://' + $('#domain').val() + '.seamlesshiring.com');
                }
                if ($(this).val().length < 1) {
                    $('#domainName').text('');
                }
            });
   

            $('#password,#confirm_password').mouseout(function () {
                if ($(this).val().length >= 1 && $(this).val().length < 8) {
                    $.growl.error({ message: "password cannot be less than 8 characters", location: 'tc', size: 'small' });
                }
            });

            $('#tos').click(function () {
                ($(this).prop('checked') == true) ?
                $('#submitButton').attr('disabled', false) :
                $('#submitButton').attr('disabled', 'disabled');
            });


            $('#submitButton').click(function (e) {
                e.preventDefault();
                $(this).attr('disabled', 'disabled');
                $('#hide-spinner').show();


                var url = "",
                    sub_form = $("#signup_form"),
                    datastring = sub_form.serialize();

                var redirect = '{{route("pricing-page")}}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: datastring,
                    dataType: "json",
                    success: function (data, status) {

                       if(data.status == true){
                            $.growl.notice({ 
                                message: data.msg, 
                                location: 'tc', 
                                size: 'large' 
                            });
                            $('#submitButton').attr('disabled', false);
                            $('#hide-spinner').hide();
                            $('.account-setup').addClass('hidden');
                            $('.account-success').removeClass('hidden');
                            window.setTimeout(function () {window.location = redirect;},9000 );
                       }else{
                            $.growl.error({ 
                                message: data.msg, 
                                location: 'tc', 
                                size: 'large' 
                            });
                            $('#submitButton').attr('disabled', false);
                            $('#hide-spinner').hide();
                       }
                    
                    },
                    error:function (data, status){
                        if(status === 'error'){
                            var error_list = (JSON.parse(data.responseText));
                            $.each(error_list.errors, function (index, value) {
                                $.growl.error({ 
                                    message: value, 
                                    location: 'tc', 
                                    size: 'large' 
                                });
                            });
                            $('#submitButton').attr('disabled', false);
                            $('#hide-spinner').hide();
                        }
                    }
                });
            });
        });
</script>

@endsection