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
                                                    <label>Full Name *</label>
                                                    <br>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter your first name and last name">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label> Work Email *</label>
                                                    <br>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter only a valid work email">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">    
                                                <div class="form-group">
                                                    <label>Company Name *</label>
                                                    <br>
                                                    <input type="text" name="contact_phone" class="form-control" placeholder="Enter company name">
                                                </div>
                                             </span>
                                            
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Phone Number *</label>
                                                    <br>
                                                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone number">
                                                </div>
                                             </span>
                                             <span class="col-xs-9">    
                                                    <div class="form-group">
                                                        <label>Preferred url *</label>
                                                        <br>
                                                        <input type="text" name="url" class="form-control" placeholder="Enter preferred name">
                                                    </div>
                                                 </span>
                                                 <span class="col-xs-3">
                                                    <div class="form-group">  
                                                        <b class="btn btn-primary" style="margin-top:24px; height:42px; margin-left:-30px; padding-top:10px; width:12em">.seamlesshiring.com</b>
                                                    </div>
                                                </span>
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Password *</label>
                                                    <br>
                                                    <input type="text" name="password" class="form-control" placeholder="Enter preferred password">
                                                </div>
                                             </span>
                                             <span class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Confirm Password*</label>
                                                    <br>
                                                    <input type="text" name="confirm_password" class="form-control" placeholder="Re-enter password">
                                                </div>
                                             </span>
                                           <span class="col-xs-12 text-center">By clicking submit, you agree to the SeamlesssHR <a href="https://seamlesshr.com/terms/">Terms of Service</a> and our <a href="https://seamlesshr.com/privacy-security/">Privacy Policy</a></span>
                                            <br>
                                            
                                            <br>
                                            <span class="col-xs-12">
                                             <input type="submit" value="Send Message" class="btn btn-primary" disabled>  
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


@endsection