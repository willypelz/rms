<style>
.trial-over{
    opacity: 0.35;
}
</style>

  <section class="s-div homepage pricing">
        <div class="container">
          
          @if(  @$account->status == 'TRIAL')

            @if( @$account->has_expired == true )
              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Hey! We bet you did <br>enjoy your trial experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
                  <h5 class="text-uppercase l-sp-5"> Choose a plan below that will best suit your needs</h5><br>
              </div>

            @else

              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Keep <br>enjoying your 14 days experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
                  <h5 class="text-uppercase l-sp-5"> Choose a plan below that will best suit your needs</h5><br>
              </div>


            @endif
          @endif

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
                                    @if( @@$account->has_expired == true or @$account->status == 'TRIAL')
                                      <div class="panel panel-default panel-pricing panel-basic trial-over">
                                    @else
                                      <div class="panel panel-default panel-pricing panel-basic">
                                    @endif

                                        <div class="panel-heading">
                                            <!-- <i class="fa fa-star"></i> -->
                                            <h3 class="text-brandon">FREE</h3>
                                            <small> For you to get a feel of the <br>SeamlessHiring magic.</small>
                                        </div>
                                        <div class="panel-body text-center text-brandon">
                                            <p class=" no-margin"><strong>14-days Access <br> to All Features:</strong></p>
                                        </div>
                                        <ul class="list-group text-center">
                                                   <li class="list-group-item">Applicant Tracking System</li>

                                                   <li class="list-group-item">Team Member Collaboration</li>

                                                   <li class="list-group-item">Background Check</li>

                                                   <li class="list-group-item">Online Tests</li>

                                                   <li class="list-group-item">Video Job Posting</li>

                                                   <li class="list-group-item">Extensive Job Broadcast</li>

                                                   <li class="list-group-item">Medical Check</li>

                                                   <li class="list-group-item">Dossier</li>

                                                   <li class="list-group-item">Customer Support</li>

                                        </ul>
                                        <div class="panel-footer">
                                            @if( @@$account->has_expired == true or @$account->status == 'TRIAL')
                                              <a class="btn btn-lg btn-primary " href="{{ route('client-signup-index') }}" disabled>BEGIN TRIAL</a>
                                            @else
                                              <a class="btn btn-lg btn-primary " href="{{ route('client-signup-index') }}">BEGIN TRIAL</a>
                                            @endif

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
                                            "><strong>3Months - &#8358;90,000</strong></p>
                                        </div>
                                        <div class="panel-body no-margin text-center text-brandon">
                                            <p class=" no-margin no-pad"><strong>1 year - &#8358;330,000</strong></p>
                                            <!-- <small>20% Discount</small> -->
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"> Full access to SeamlessHiring database for candidate search</li>
                                            <li class="list-group-item"> 5% off Video Job Posting</li>
                                            <li class="list-group-item">3 Team Members</li>
                                            <li class="list-group-item">Unlimited Job Posting on Free Job Boards</li>
                                            <li class="list-group-item">5% off Online Tests, Background & Medical Checks, Discount on Newspaper Ads</li>
                                            <li class="list-group-item">Dedicated Relationship Manager for Resource Support</li>

<!--                                            <li class="list-group-item">3 Team Members</li>-->

                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-block btn-success text-uppercase" data-toggle="modal" data-target="#requestCall" id="modalButton" href="#requestCall" data-title="Request a call">Request a call</a>
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
                                            <li class="list-group-item">20% off Video Job Posting </li>
                                            <li class="list-group-item"> Analytics Reporting</li>
                                            <li class="list-group-item">Different Access Levels for Admin</li>
                                            <li class="list-group-item">Unlimited Team Collaboration</li>
                                            <li class="list-group-item">Unlimited Job Posting on Paid/Free Job Boards</li>
                                            <li class="list-group-item">10% off Online Tests, Background & Medical Checks, Discount on Newspaper Ads </li>
                                            <li class="list-group-item">Company In-House Talent Resource  and Periodic Refresher Training on Portal Updates</li>
                                            <li class="list-group-item">Dedicated  Relationship Manager for 24/7 Resource Support </li>
                                        </ul>
                                        <div class="panel-footer">
                                            <a class="btn btn-lg btn-warning text-uppercase" data-toggle="modal" data-target="#requestCall" id="modalButton" href="#requestCall" data-title="Request a call">Request a call</a>
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

        <div class="container hidden">
          <hr>
           <div class="row">
               <div class="col-xs-12"><h4 class="text-center">All Plans include all of these features:</h4> <br></div>
               <div class="col-xs-4 col-xs-offset-2">
                   <ul class="list-unstyled">
                       <li>Applicant Tracking System</li>
                       <li>Team Member Collaboration</li>
                       <li>Background Check</li>
                       <li>Online Tests</li>
                       <li>Video Job Posting</li>
                       <li>Extensive Job Broadcast</li>
                       <li>Medical Check</li>
                       <li>Dossier</li>
                       <li>Customer Support</li>
                   </ul>
               </div>
           </div>
       </div>
    </section>

<!--
   <section>

   </section>
-->
  

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
                        <span class="col-xs-6">
                          <div class="form-group">
                              <label for="">Company Name</label><span class="text-danger">*</span>
                              <input type="text" class="form-control" name="company_name" id="company_name" required>
                          </div>
                        </span>
                        <span class="col-xs-6">
                            <div class="form-group">
                                <label for="">Preferred package</label><span class="text-danger">*</span>
                                <select class="form-control" name="package" id="package_name" required>
                                  <option>--select package-- </option>
                                  <option value="SME"> SME</option>
                                  <option value="PREMIUM">PREMIUM </option>
                                 
                                </select>
                            </div>
                        </span>
                        <span class="col-xs-6">
                        <div class="form-group">
                            <label for="">First Name</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="firstname" id="firstname" required>

                        </div>
                      </span>
                      <span class="col-xs-6">
                        <div class="form-group">
                            <label for="">Lastname</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="surname" id="surname" required>

                        </div>
                      </span>
                      <span class="col-xs-6">
                        <div class="form-group">
                            <label for="">Phone number</label><span class="text-danger">*</span>
                            <input type="tel" class="form-control" name="phone" id="phone" required>
                        </div>
                      </span>
                      <span class="col-xs-6">
                        <div class="form-group">
                            <label for="">Your Email</label><span class="text-danger">*</span>
                            <input type="email" class="form-control" name="email" id="email" required>

                        </div>
                      </span>
                    </div>

                </div>

                <div class="row"><br>

                    <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                        <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                    </div>

                    

                </div>
            </form>

            <script>
                $(document).ready(function(){
                   $('body #request-form').on('submit', function(e){
                        e.preventDefault();
                        field = $(this);
                        params = {
                            company_name : $('#company_name').val(),
                            package: $('#package_name').val(),
                            firstname : $('#firstname').val(),
                            surname : $('#surname').val(),
                            phone : $('#phone').val(),
                            email : $('#email').val(),
                            _token: "{{ csrf_token() }}" 
                        };
                        $("body #request-form input").prop("disabled", true);

                        $.ajax({
                                url: "{{ route('request-a-call') }}",
                                method: 'post', 
                                data:params,
                                success:function(data, status){
                                    // $('#reviewBtn-' + $field.data('app-id') ).trigger('click');
                                    
                                    $( '#requestCall' ).modal('toggle');

                                    $('#company_name').val("");
                                    $('#package_name').val("");
                                    $('#firstname').val("");
                                    $('#surname').val("");
                                    $('#phone').val("");
                                    $('#email').val("");
                                    $("body #request-form input").prop("disabled", false);
                                  
                                    $.growl.notice({ message: "Your request has been sent",location: 'tc', size: 'large' });
                                },
                                error:function(data, status){
                                  if(status === 'error'){
                                  var error_list = (JSON.parse(data.responseText));
                                 
                                     $.each(error_list.errors, function (index, value) {
                                            $.growl.error({ 
                                                message: value, 
                                                location: 'tc', 
                                                size: 'large' 
                                            });
                                      });
                                  }
                                }
                            });
                    });
                });
              </script>
      </div>
    </div>
  </div>
</div>
