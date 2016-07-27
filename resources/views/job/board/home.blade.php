@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
            @if($job['status'] != 'DELETED')
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                            @include('job.board.job-board-tabs')
                        
                            <div class="tab-content">

                        <div class="row">                           
                        <!-- applicant -->

                            <div class="col-xs-8">

                                <div class="panel panel-default">
                                
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Advertise on Job Boards 
                                    <span class="pull-right text-warning"><i class="fa fa-check-circle"></i> 4 approved &nbsp; &middot; &nbsp;<i class="fa fa-hourglass-half"></i> 3 Pending</span>
                                    <!-- <a href="" class="btn-sm btn btn-danger pull-right"><i class="fa fa-send"></i> Promote Job</a> --></h3>
                                  </div>
                                  <div class="panel-body">
                                  <p class="text-muted">You can copy the link of your job or share them from here.</p>


                                    <div class="row job-board approved">
                                      <div class="col-xs-3"><br>
                                        <img src="{{ url('/') }}/img/logo-full.png" alt="insidify logo" width="90%" align="right">
                                      </div>
                                      <div class="col-xs-6">
                                        <h5 title="Your Job is live on this website">Insidify.com <i class="fa fa-check-circle text-success"></i> </h5><input type="text" class="form-control" value="http://localhost/seamlesshiring/public_html/job/promote/22" readonly>
                                        <!-- <div class="clearfix"></div>
                                        <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                      </div>
                                      <div class="col-xs-3">
                                      <h5>Share this link</h5>
                                        <ul class="list-inline">
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                           </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                    </div>


                                    <div class="row job-board approved">
                                      <div class="col-xs-3"><br>
                                        <img src="{{ url('/') }}/img/efritin-logo.png" alt="insidify logo" width="90%" align="right">
                                      </div>
                                      <div class="col-xs-6">
                                        <h5  title="Your Job is live on this website">Efritin.com Jobs <i class="fa fa-check-circle text-success"></i> </h5><input type="text" class="form-control" value="http://localhost/seamlesshiring/public_html/job/promote/22" readonly>
                                        <!-- <div class="clearfix"></div>
                                        <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                      </div>
                                      <div class="col-xs-3">
                                      <h5>Share this link</h5>
                                        <ul class="list-inline">
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                           </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                    </div>


                                    <div class="row job-board approved">
                                      <div class="col-xs-3"><br>
                                        <img src="{{ url('/') }}/img/job_informant.PNG" alt="Job Informat logo" width="90%" align="right">
                                      </div>
                                      <div class="col-xs-6">
                                        <h5  title="Your Job is live on this website">Job Informant <i class="fa fa-check-circle text-success"></i> </h5><input type="text" class="form-control" value="http://localhost/seamlesshiring/public_html/job/promote/22" readonly>
                                        <!-- <div class="clearfix"></div>
                                        <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                      </div>
                                      <div class="col-xs-3">
                                      <h5>Share this link</h5>
                                        <ul class="list-inline">
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   <a href="" class="btn-disabled" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-"></i>
                                                             <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                           </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                    </div>


                                    <div class="row job-board pending">
                                      <div class="col-xs-3">
                                      <br>
                                        <img src="{{ url('/') }}/img/linkedin-logo.png" alt="insidify logo" width="90%" align="right">
                                      </div>
                                      <div class="col-xs-6">
                                        <h5>Linkedin<i class="fa fa-hourglass-half text-muted"></i> pending approval</h5><input type="text" class="form-control" value="your url will appear here" disabled="">
                                        <!-- <div class="clearfix"></div>
                                        <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                      </div>
                                      <div class="col-xs-3">
                                      <h5>Share this link</h5>
                                        <ul class="list-inline">
                                               <li class="no-pad no-margin">
                                                   
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                          
                                              </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                    <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                                           </span>
                                               </li>
                                           </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                    </div>


                                    <div class="row job-board pending">
                                      <div class="col-xs-3">
                                      <br>
                                        <img src="{{ url('/') }}/img/brws.png" alt="insidify logo" width="90%" align="right">
                                      </div>
                                      <div class="col-xs-6">
                                        <h5>LoremIpsum.ng <i class="fa fa-hourglass-half text-muted"></i> pending approval</h5><input type="text" class="form-control" value="your url will appear here" disabled="">
                                        <!-- <div class="clearfix"></div>
                                        <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                      </div>
                                      <div class="col-xs-3">
                                      <h5>Share this link</h5>
                                        <ul class="list-inline">
                                               <li class="no-pad no-margin">
                                                   
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                          
                                              </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                    <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                               </li>
                                                                              
                                               <li class="no-pad no-margin">
                                                   
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-square fa-stack-2x text-muted"></i>
                                                             <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                                           </span>
                                               </li>
                                           </ul>
                                      </div>
                                      <div class="clearfix"></div>
                                      <hr>
                                    </div>


                                    <!-- <u class="text-center"><a href=""><i class="fa fa-plus"></i> Add Job board</u></a> -->


                                    <div class="well text-center">
                                      <p class="lead">For a wider and better reach, <br>you can promote this job on more job boards and <i>newspapers.</i></p>
                                      <p>
                                        <a href="" class="btn btn-danger btn-">
                                          <i class="fa fa-send"></i> Promote Job now
                                        </a>
                                      </p>
                                    </div>


                                  </div>
                                </div>

                            </div>

                            <div class="col-xs-4">
                               <div class="well text-center">
                                      <p class="lead">For a wider and better reach, <br>you can promote this job on more job boards and <i>newspapers.</i></p>
                                      <p>
                                        <a href="" class="btn btn-primary btn-block">
                                          <i class="fa fa-send"></i> Promote Job now
                                        </a>
                                      </p>
                                    </div>

                               <!--  <div class="panel panel-default">                                
                                  <div class="panel-heading">
                                    <h3 class="panel-title text-center">Refer this Job</h3>
                                  </div>
                                  <div class="panel-body">
                                  <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab omnis ipsa, quis beatae ex nam excepturi quae sequi molestias dolorem deserunt voluptas corrupti fugit eum totam nobis dicta officiis mollitia.</p>
                                    <a href="#modalRefer" data-toggle="modal" data-target="#modalRefer" class="btn btn-primary btn-block">Make Referals</a>
                                  </div>
                                </div> -->

<!--
                                <div class="panel panel-default">
                                
                                  <div class="panel-heading">
                                    <h3 class="panel-title text-center">Share on Social Media</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="text-center">
                                   <p class="">Share this job directly on LinkedIn, Twitter, Facebook. </p><br>
                               
                                           <ul class="list-inline">
                                               <li>
                                                   <a href="https://www.facebook.com/sharer/sharer.php?u={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-2x">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li>
                                                   <a href="https://twitter.com/home?status={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-2x">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li>
                                                   <a href="https://plus.google.com/share?url={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-2x">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                           </ul>
                                   </div>
                                  </div>
                                </div>
-->
                                
                            </div>

                                
                        </div>

                        <!--<div class="panel panel-default">-->
                        <!--<div class="panel-heading">-->
                        <!--<h4 class="panel-title">Friends who work <p>Medical Doctor, Valuepreneur, Doer... </p></h4>-->
                        <!--</div>-->
                        <!--<div class="panel-collapse skill">-->
                        <!--<div class="panel-body">-->
                        <!--<a href="#" class="btn btn-info" role="button">CSS</a> <a href="#" class="btn btn-info" role="button">HTML</a> <a href="#" class="btn btn-info" role="button">jQuery</a>-->
                        <!--</div>-->
                        <!--</div>-->
                        <!--</div>-->

                    </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
            @else
              @include('job.board.includes.job-deleted')
            @endif
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection



<div class="modal fade" id="modalRefer">
<div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Refer people to this Job</h4>
      </div>
    <div class="modal-body">
      <div class="alert alert-success"><i class="fa fa-check fa-lg"></i>
           &nbsp; Your mail has been sent. Refresh page to send more.</div>
          <form action="">
      
          <div class="form-group">
              <label for="">From: </label>
              <input class="form-control" type="text" value="dejilana@insidify.com" disabled>
              
              <label for="">To: </label>
              <small>Separate your addresses by a comma</small>
              <input class="form-control" type="text" placeholder="email addresses here">
          </div>
      
          <label for="editor1">Body of Mail</label>
              <textarea name="" id="editor1" cols="30" rows="10">
              <p>Hello there, I have a job you might be interested in</p>
              <hr style="width: 45%">
                  <strong class="">Human Resource Administrator<br>
                      <small>at Kingston Industries</small>
                  </strong>
                  <p>
                      <a href="job-page.php">Visit this link to see Job details.</a>
                  </p>
                  <p>Thank you.</p>
              </textarea>
              <script>
                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace( 'editor1' );
              </script>
          </form>
          <br>
          <p>
              <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-line btn-sm"><i class="fa fa-times"></i> &nbsp; Cancel</a>
      
              <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-success btn-sm pull-right">Send Mail &nbsp; <i class="fa fa-send"></i></a>
          </p>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
      $('#sjb').on('click', function(){

          $this = $(this);

          if( $this.is(':checked') )
          {
            type = 'add';
          }
          else
          {
            type = 'remove';
          }

            $.ajax
            ({
              type: "POST",
              url: "{{ route('cart') }}",
              data: ({ rnd : Math.random() * 100000, board_id: $this.attr('data-i'), name:$this.attr('data-n'), type:type, 'qty':1, 'price':$this.attr('data-p'), "_token":"{{ csrf_token() }}", cart_type:'jobBoards'}),
              success: function(response){
          
              }
          });
      });
  });
  
</script>
