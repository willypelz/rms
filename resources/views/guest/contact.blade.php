@extends('layout.template-default')

@section('content')


  <section class="s-div homepage">
        <div class="container">

            <div class="row text-center text-light text-white"><br>
                <h1> Contact Us</h1>
                <h1 class="lead">We would love to hear from you.</h1>
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
                                <div class="col-xs-3 col-xs-offset-1">
                                    <div class="well">
                                    <p>We look forward to your - enquiries, questions or suggestions. <!-- Visit our FAQs to browse popular support topics --></p>
                                    <hr>
                                    <p class="">
                                        <!-- <i class="fa fa-envelope"></i> --> Mail Address: <b>contactus@seamlesshiring.com</b>
                                    </p>
                                    <hr>
                                    <p>
                                        <!-- <i class="fa fa-phone"></i> --> Put a call to us on <b>01-2911091</b> or <b>08167134495</b> (Mon - Fri, 8:30am - 5:00pm)
                                    </p>
                                    </div>
                                </div>
                                <div class="col-xs-7 contact">
                                  @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                            {{Session::get('flash_message')}}<br>
                          </div>
                        @endif
                        
                                    <div class="clearfix">

                                        <span class="col-xs-6">
                                            <div class="form-group">
                                                <label>Your Name *</label>
                                                <br>
                                                <input type="text" name="name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Your Email Address *</label>
                                                <br>
                                                <input type="email" name="email" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Your Contact Phone</label>
                                                <br>
                                                <input type="text" name="contact_phone" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>Job Title</label>
                                                <br>
                                                <select class="form-control" name="enquiry_name">
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </span>

                                        <span class="col-xs-6">
                                            <div class="form-group">
                                                <label>What can we help you with? *</label>
                                                <br>
                                                <select class="form-control" name="enquiry_name">
                                                    <option value="">Make a Selection</option>
                                                    <option value="">Sales</option>
                                                    <option value="">Support</option>
                                                    <option value="">Partner Requests</option>
                                                    <option value="">Press</option>
                                                    <option value="">Concerns</option>
                                                    <option value="">Report a Bug</option>
                                                    <option value="">Other</option>
                                                </select>
                                            </div>

                                            <label>Your Message here *</label>
                                            <br>
                                            <textarea placeholder="" name="msg" class="form-control" rows="12"></textarea>

                                            <br>
                                            <input type="submit" value="Send Message" class="btn btn-success">
                                        </span>
                                    </div>
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
        <a href="{{ url('register') }}" class="btn btn-danger btn-lg"> Get Started</a>
      </div>
    </div><div class="clearfix"><br></div>
  </div>
</section>


@endsection