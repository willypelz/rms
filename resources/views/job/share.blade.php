@extends('layout.template-user')

@section('content')


<div class="separator separator-small"></div>
    <section class="s-div green about hidden">
        <div class="container">

            <div class="row pagehead text-center">
                <h1>About Us</h1>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h5 class="no-margin text-center text-uppercase l-sp-5 text-brandon">Promote your Job</h5><br>
                    <div class="page">

                        <div class="btn-group btn-group-justified btn-progress" role="group" aria-label="...">
                          
                          <div class="btn-group" role="group">
                            <a href="{{ route('advertise', [$job->id]) }}" type="button" class="btn btn-line text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">2. advertise</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary text-capitalize"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">3. sharing</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ route('add-candidates', false) }}" type="button" class="btn btn-line text-capitalize text-muted"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">4. add candidates</span></a>
                          </div>
                        </div>

                        
                        <div class="row">
                            
                           <div class="col-sm-8 col-sm-offset-2">
                                <div class="separator separator-small">
                                   <h3 class="text-center"> Share this job!  <br>
                                       <small>We want to help you find the best talent anywhere they may be.</small>
                                   </h3><hr style="width: 45%">
                               </div>

                               <!-- Email Job -->
                               <div class="col-md-6">
                                   <div class="">
                               
                                   <p class="text-brandon text-uppercase">
                                       Referal
                                   </p>
                               
                                       <p> <b>Use your network to attract great talent!</b><br>
                                          Maximize the power of Referrals by sending this job to everyone on your network. 
                                          </p><br>

                                       <p>
                                           <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-line"><i class="fa fa-envelope"></i> &nbsp; Get Referrals for this job</a>
                                       </p>
                                       <div class="separator separator-small"></div>
                                   </div>
                               </div>

                               <div class="col-md-6 text-right">

                               
                                   <p class="text-brandon text-uppercase">
                                       Cast your Social Net!


                                   </p>
                                   <p>Share this job on your social media channels.</p>
                               
                                           <ul class="list-inline">
                                             <li>
                                               <a href="" class="">
                                                       <span class="fa-stack fa-2x">
                                                         <i class="fa fa-circle fa-stack-2x text-"></i>
                                                         <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                       </span>
                                               </a>
                                             </li>
                                                                            
                                             <li>
                                               <a href="" class="">
                                                       <span class="fa-stack fa-2x">
                                                         <i class="fa fa-circle fa-stack-2x text-"></i>
                                                         <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                       </span>
                                               </a>
                                             </li>
                                                                            
                                             <li>
                                               <a href="" class="">
                                                       <span class="fa-stack fa-2x">
                                                         <i class="fa fa-circle fa-stack-2x text-"></i>
                                                         <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                       </span>
                                               </a>
                                             </li>
                                           </ul>
                                   </div><!-- End of Job sharing -->
                               
                                         <!--   <a href="" class="">
                                                   <span class="fa-stack fa-2x">
                                                     <i class="fa fa-circle fa-stack-2x text-"></i>
                                                     <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                   </span>
                                           </a>
                                   </div>
                                -->
                                <div class="col-sm-12">
                                  
                                    
                                    <div class="hideSendEmails"></div>
                                    <div class="collapse" id="collapseWYSIWYG">
                                       <div class="alert alert-success hidden"><i class="fa fa-check fa-lg"></i>
                                            &nbsp; Your mail has been sent. Refresh page to send more.</div>
                                           <form action="">

                                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">


                                           <div class="form-group">
                                               <label for="">From: </label>
                                               <input class="form-control" type="text" value="{{ $company->email.', '.$company->name }}" disabled>
                                               
                                               <label for="">To: </label>
                                               <small>Separate your addresses by a comma</small>
                                               <input class="form-control" id="to_email" name="to_email" type="text" placeholder="email addresses here">
                                           </div>

                                           <label for="editor1">Body of Mail</label>
                                               <textarea name="email_body"  id="editor1" cols="30" rows="10">
                                               <p>Hello there, I have a job you might be interested in</p>
                                               <hr style="width: 45%">
                                                      
                                                     Trust this email meets you well. We are currently recruiting for <b>“{{ $job->title }}”</b> at <b>“{{ $company->name }}”</b>. 
                                                     <br>
                                                     Here is a link to the job http://seamless.org 
                                                      <br>
                                                      Kindly share the job opening with qualified candidates within your network.
                                                      <br><br>
                                                    
                                                      <p>Many thanks.<br>
                                                      {{ $user->name }},<br>
                                                      {{ $company->name }}</p>
                                                      <!-- Company name. -->



                                                   </p>
                                               </textarea>
                                               <script>
                                                   // Replace the <textarea id="editor1"> with a CKEditor
                                                   // instance, using default configuration.
                                                   CKEDITOR.replace( 'editor1' );
                                               </script>
                                           </form>
                                           <br>
                                           <div style="color:red" id="ErrorMsg"></div>
                                           <p>
                                               <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-line btn-sm"><i class="fa fa-times"></i> &nbsp; Cancel</a>

                                               <a role="button" id="ReferEmail" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-success btn-sm pull-right">Send Mail &nbsp; <i class="fa fa-send"></i></a>
                                           </p>
                                    </div>

                                      <script>
                                          $('#ReferEmail').click(function(){
                                              $(".hideSendEmails").html('<img src="{{ asset('img/loader-logo-32.gif') }}" width="30px" /> please wait...');

                                              var to = $('#to_email').val()
                                              var body = $('#editor1').val()
                                              var token = $('#token').val()
                                              var jobid = "{{ $job->id }}"

                                              if (to == null || to == "") {
                                                  $('#ErrorMsg').html('Recipient name is missing')
                                                  return false;
                                              }

                                              var url = "{{ route('refer-job') }}"
                                               $.ajax
                                              ({
                                                  type: "POST",
                                                  url: url,
                                                  data: ({ rnd : Math.random() * 100000, _token:token, to:to, body:body, jobid:jobid }),
                                                  success: function(response){
                                                       if(response == 'sent'){
                                                           $(".hideSendEmails").hide();
                                                           $(".collapseWYSIWYG").show();

                                                       }
                                                  }
                                              });


                                          })
                                    </script>

                         
                                </div>
                             
                               <!-- Job Embed -->
                               <!-- <div class="col-md-4">
                                   <p class="text-brandon text-uppercase text-right">
                                       Embed on your Site
                                   </p>                                   
                           
                                   <p class="text-right">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima aut magnam eum, aspernatur officia amet quibusdam nam.</p><br>

                                   <p>
                                       <a href="" class="pull-right btn btn-line"><i class="fa fa-cogs"></i> &nbsp;Get the Widget</a>
                                   </p>

                               </div> -->

                                   <div class="col-md-6 col-md-offset-3">
                                       
                               
                                           <div class="separator separator-small"></div>
                                           <hr style="width: 50%">
                                           <p class="text-center">
                                               <!-- <a href="addCan-job.php"> Skip this step </a> -->
                                                       <!-- &nbsp; &middot; &nbsp; -->
                                               <a href="{{ route('add-job-candidates', [$job->id]) }}" class="btn btn-success">Proceed &raquo;</a>
                                           </p>
                                           
                                   </div>
                               <div class="clearfix"></div>
                           </div>

                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"></div>


@endsection