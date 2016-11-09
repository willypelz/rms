@extends('layout.template-default')

@section('content')


  <section class="s-div homepage pricing">
        <div class="container">

            <div class="row text-center text-brandon text-light text-white">
                <h1>Get a Free Trial Now!</h1>
                <h5 class="text-uppercase l-sp-5"> 14 days of free and unlimited Access on all plan</h5><br>
            </div>

        </div>
    </section>


    <section class="white min" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">

                    <div class="">



                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane in active animated zoomIn" id="monthly">
                              <div class="row" style="margin-bottom:0em">
                                  <br>
                                <div class="col-sm-4 text-center no-pad">
                                  <!-- <img src="img/rope.png" width="100px" class="rope"> -->
                                    <div class="panel panel-default panel-pricing panel-basic">
                                        <div class="panel-heading">
                                            <!-- <i class="fa fa-star"></i> -->
                                            <h3 class="text-brandon">FREE</h3>
                                            <small> For you to get a feel of the <br>SeamlessHiring magic.</small>
                                        </div>
                                        <div class="panel-body text-center text-brandon">
                                            <p class=" no-margin"><strong>&#8358; 0 / Month</strong></p>
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"> Free and unlimited job posting</li>
                                            <li class="list-group-item"> Limited access to the recruitment platform</li>
                                            <!--<li class="list-group-item"> 27/7 support</li>-->
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-line " href="{{ url('register') }}">BEGIN TRIAL</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /item -->

                                <!-- item -->
                                <div class="col-sm-4 text-center no-pad">
                                  <!-- <img src="img/rope-big.png" width="300px" class="rope big"> -->
                                    <div class="panel panel-default panel-pricing panel-sme">
                                        <div class="panel-heading">
                                            <!-- <i class="fa fa-star"></i><i class="fa fa-star"></i> -->
                                            <div class="label label-default">&nbsp; MOST POPULAR &nbsp;</div>
                                            <h3 class="text-brandon">SME</h3>

                                            <small>For companies that post 1-3 jobs per month and hire between 5-10 candidates in a year.</small>
                                        </div>
                                        <div class="panel-body no-margin text-center text-brandon" style="
                                                background: #2889ce;
                                            ">
                                            <p class=" no-margin no-pad" style="
                                                background: #2889ce;
                                            "><strong>₦ 30,000 / Mo</strong></p>
                                        </div>
                                        <div class="panel-body no-margin text-center text-brandon">
                                            <p class=" no-margin no-pad"><strong>&#8358; 300,000 / Year</strong></p>
                                            <!-- <small>20% Discount</small> -->
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"> Free unlimited job posting.</li>
                                            <li class="list-group-item"> <b>Unlimited</b> processing access to 5 jobs/month. (Request a Call for more posting)</li>
                                            <!--<li class="list-group-item"><i class="fa fa-check"></i> 10 free IQ Test</li>-->
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-block btn-success " href="{{ url('register') }}">START HERE!</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /item -->


                                <!-- item -->
                                <div class="col-sm-4 text-center no-pad">
                                  <!-- <img src="img/rope.png" width="100px" class="rope"> -->
                                    <div class="panel panel-default panel-pricing panel-premium">
                                        <div class="panel-heading">
                                            <!-- <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> -->
                                            <h3 class="text-brandon">PREMIUM</h3>
                                            <small> For companies that post more than 3 jobs per month and hire over 10 candidates in a year. </small>
                                        </div>
                                        <div class="panel-body text-center">
                                            <p class=" no-margin text-brandon" style=" font-size: 17px;    padding: 12px;"><strong>CALL US ON 08068873719</strong></p>                                        
                                        </div>
                                        <ul class="list-group text-center">
                                            <!-- <li class="list-group-item"> Unlimited free job posting.</li>
                                            <li class="list-group-item"> Unlimited processing access unlimited jobs/month.</li>
                                            <li class="list-group-item"> 24/7 dedicated staff support</li>
                                            <li class="list-group-item"> Free embed on your career site. </li>
                                            <li class="list-group-item"> Discounts on value added services. </li> -->

                                            <li class="list-group-item">Full access to SeamlessHiring database for candidate search</li>
                                            <li class="list-group-item">Unlimited CV downloads and analytics reporting</li>
                                            <li class="list-group-item"> 10% discount on all newspaper job adverts</li>
                                            <li class="list-group-item">100 free SeamlessHiring tests per month and a 20% discount on the next 1,000 tests every month</li>
                                            <li class="list-group-item">20 free bulk SMS per job</li>
                                            <li class="list-group-item">Discounted rates for pre-employment background and medical checks</li>
                                            <li class="list-group-item">Different access levels for Admin</li>
                                            <li class="list-group-item">Training for your company in-house talent resource and periodic refresher programs on what’s new on the portal</li>
                                            <li class="list-group-item">Dedicated Relationship Manager for 24/7 resource support </li>
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-line text-uppercase" data-toggle="modal" data-target="#requestCall" id="modalButton" href="#requestCall" data-title="Request a call">Request a call</a>


                                        </div>
                                    </div>
                                </div>
                                <!-- /item -->

                            </div>
                        </div>


                      </div>
                      <!-- End of Tab panes -->



                      <!-- <div id="" class="col-sm-12">
                        <div class="text-center">
                            <div class="col-sm-4 col-sm-offset-4">
                            <br>
                                <a href="{{ url('register') }}" class="btn btn-lg btn-block btn-success btn-trial">
                                    Get Started for free
                                </a>
                            </div>
                        </div>
                      </div> -->
                        <div class="clearfix"></div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="s-div no-margin blue dark">
        <div class="container">

            <div class="page-trans">
              <div class="row">
                  <div class="col-sm-8 col-sm-offset-2 text-white ">
                      <br>

                      <i class="fa fa-question-circle fa-5em text-center block"></i>
                      <h3 class="text-brandon text-uppercase no-margin text-center">
                      WHY SHOULD MY COMPANY PAY <br>TO USE SeamlessHiring?</h3><br>
                      <div class="row">
                      <div class="col-sm-4 col-sm-offset-4">
                        <hr>
                      </div>
                            <div class="col-sm-12">
                                <h4 class="text-brandon text-green-light">1. You Will Reach the Highest Number of High Quality Candidates Through SeamlessHiring.</h4>

                                <p>Since you can broadcast your jobs on over 30 channels including Insidify.com, Jobberman, myjobmag, ngcareers, Newspapers (Guardian, Punch, Vanguard and TheNation), facebook, twitter and Linked-In. You will reach far more candidates than any job platform in Nigeria.</p>
                                <p>Of course, this means you don’t need to have employer accounts everywhere.   </p>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3"><hr class="pull-left"></div>
                            <div class="col-sm-12">
                                <h4 class="text-brandon text-green-light">2.  You Will be Able to Sort and Filter Through These Candidates With Ease. </h4>

                                <p>Ultimately, what’s important is the quality of candidates you finally get, not the fact that a crowd applied. SeamlessHiring helps you find the best people amongst your applicants with ease. </p>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3"><hr class="pull-left"></div>
                            <div class="col-sm-12">
                                <h4 class="text-brandon text-green-light">3.  You Will be Able to Track All the Stages of the Recruitment Process Seamlessly. </h4>

                                <p>-  From posting the jobs, to sorting applicants, reviewing and shortlisting, online testing, scheduling & conducting interviews, to background checks and pre-employment medicals. It’s all incredibly seamless.</p>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3"><hr class="pull-left"></div>
                            <div class="col-sm-12">
                                <h4 class="text-brandon text-green-light">4.  SeamlessHiring Makes the Recruitment Process  Fast and Easy </h4>

                                <p>By making recruitment seamless, we will be saving you the time and hassle of posting jobs everywhere, sorting through endless piles of emails, conducting tests, background checks, medicals and a lot more. </p>
                                <p>SeamlessHiring shortens recruitment time by over 80%.</p>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3"><hr class="pull-left"></div>
                            <div class="col-sm-12">
                                <h4 class="text-brandon text-green-light">5.  SeamlessHiring Saves you Money.</h4>

                                <p>Because we use very intelligent technology, we are able to deliver high value to you at a very cheap price. SeamlessHiring cuts the real value of finding great talent by over 65%. </p>
                                
                            </div>
                            <div class="col-sm-6 col-sm-offset-3"><hr class="pull-left"></div>
                      </div>
                    <!-- <div class="row">
                        <br>
                        <form class="form-inline">
                            <div class="col-sm-2">
                                <h4>&nbsp; I NEED A</h4>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control input-full" placeholder="e.g Human Resource Person">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" value="Request" class="btn btn-block btn-default">
                            </div>
                        </form>

                    </div> <br>-->
                    </div>
                </div>
            </div>
            <div class="separator separator-small"><br></div>
        </div>
    </section>



    <section class="s-div homepage">
        <div class="container">

            <div class="">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <i class="fa fa-smile-o fa-5em text-center block text-white"></i>
                    <p class="lead text-center text-white">Do you need to convince your boss or your team on why you need SeamlessHiring? We have put a customizable, four-page power-point presentation together for you.  
                    </p>
                      <form action="">
                        <div class="form-group">
                          <div class="col-sm-6"><input type="text" class="form-control input-lg" placeholder="Enter your company name"></div>
                          <div class="col-sm-6"><input type="email" class="form-control input-lg" placeholder="Your email address"></div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-6"><input type="text" class="form-control input-lg" placeholder="Your name"></div>
                          <div class="col-sm-6"><input type="submit" class="btn btn-success btn-block btn-lg" value="Download your Pitch Deck"></div>
                          <div class="clearfix"></div>
                        </div>
                      </form>
                </div>
                </div>
                <br>
            </div>

        </div>
    </section>

<div class="modal widemodal fade" id="requestCall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">×</button>
        <h4 class="modal-title" id="myModalLabel">Request a call</h4>
      </div>
      <div class="modal-body">
          <form role="form" class="form-signin" method="POST" id="request-form" action="">
                {!! csrf_field() !!}
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" required>

                        </div>

                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" required>

                        </div>

                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="text" class="form-control" name="surname" id="surname" required>

                        </div>

                        <div class="form-group">
                            <label for="">Phone number</label>
                            <input type="tel" class="form-control" name="phone" id="phone" required>

                        </div>


                        <div class="form-group">
                            <label for="">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>

                        </div>
                    </div>

              

                </div>

                <div class="row"><br>

                    <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                        <button type="submit" class="btn btn-success btn-block">Request &raquo;</button>
                    </div>

                    

                </div>
            </form>

            <script>
                $(document).ready(function(){
                   $('body #request-form').on('submit', function(e){
                        e.preventDefault();
                        $field = $(this);
                        params = {
                            company_name : $('#company_name').val(),
                            firstname : $('#firstname').val(),
                            surname : $('#surname').val(),
                            phone : $('#phone').val(),
                            email : $('#email').val(),
                        };
                        $("body #request-form input").prop("disabled", true);

                        $.post("{{ route('request-a-call') }}", params,function(data){
                                // $('#reviewBtn-' + $field.data('app-id') ).trigger('click');
                                
                                $( '#requestCall' ).modal('toggle');

                                $('#company_name').val("");
                                $('#firstname').val("");
                                $('#surname').val("");
                                $('#phone').val("");
                                $('#email').val("");
                                $("body #request-form input").prop("disabled", false);

                                $.growl.notice({ message: "Your request has been sent",location: 'tc', size: 'large' });
                            });
                    });
                });
              </script>
      </div>
    </div>
  </div>
</div>


@endsection