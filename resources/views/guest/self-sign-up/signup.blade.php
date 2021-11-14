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


 <section class="white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="">
                        <br>
                        <div class="pagehead">
                            <form method="post" action="">
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
                                                    <input type="text" name="contact_phone" class="form-control" placeholder="Name of your organisation">
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
                                                    <input type="text" name="password" class="form-control" placeholder="Preferred password">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Confirm Password </label> <span class="text-danger">*</span>
                                                    <br>
                                                    <input type="text" name="confirm_password" class="form-control" placeholder="Re-enter password">
                                                </div>
                                             </span>
                                           <span class="col-xs-12 text-center">By clicking submit, you agree to the SeamlesssHR <a href="https://seamlesshr.com/terms/">Terms of Service</a> and our <a href="https://seamlesshr.com/privacy-security/">Privacy Policy</a></span>
                                            <br>
                                            
                                            <br>
                                            <span class="col-xs-12">
                                             <input type="submit" value="Create My Account" class="btn btn-primary" disabled>  
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
{{-- <script src="{{secure_asset('js/jquery-1.11.1.min.js') }}"> --}}
    alert('f');
        $(document).ready(function () {
            $('#domain').keyup(function () {
                if ($(this).val().length > 1) {
                    $('#domainName').text($('#domain').val() + '.mygo1.com');
                }
                if ($(this).val().length < 1) {
                    $('#domainName').text('');
                }
            });
</script>

@endsection