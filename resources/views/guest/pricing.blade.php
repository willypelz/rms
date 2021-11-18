@extends('layout.template-default')

@section('content')

<style>
.trial-over{
    opacity: 0.35;
}
</style>

  <section class="s-div homepage pricing">
        <div class="container">
          @if( !Auth::check() )
            <div class="row text-center text-brandon text-light text-white">
               <br>
                <h1>Get a Free Trial Now!</h1>
                <h5 class="text-uppercase l-sp-5"> 14 days of free and unlimited Access on all plans</h5><br>
            </div>
          @endif

          @if(  @$account->status == 'TRIAL')

            @if( @$account->has_expired == true )
              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Hey! We bet you did <br>enjoy your 14 days experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
              </div>

            @else

              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Keep <br>enjoying your 14 days experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
              </div>


            @endif
          @endif

        </div>

    </section>

<!--
   <section>

   </section>
-->


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

                                <p>Since you can broadcast your jobs on over 30 channels including Jobberman, myjobmag, ngcareers, facebook, twitter and LinkedIn. You will reach far more candidates than any job platform in Nigeria.</p>
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
