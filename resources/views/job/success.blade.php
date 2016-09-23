@extends('layout.template-default')

@section('content')



  <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <!-- <div class="btn-group btn-group-justified btn-progress" role="group" aria-label="...">
                          
                          <div class="btn-group" role="group">
                            <button type="button" class="btn active text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">Job Promotion</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize text-muted"><i class="fa fa-plus"></i>
                            &nbsp; <span class="hidden-xs">Add candidates</span></a>
                          </div>
                        </div>
                        <div> -->
                    
                    <div class="page">


                        <div class="row text-center">
                          <div class="col-xs-10 col-xs-offset-1">
                          <h2><i class="fa fa-check-circle fa-2x text-success"></i></h2>
                          <p class="lead">Your Job has been succesfully posted.</p><hr>
                          <div class="well hidden"><ul class="list-inline">
                            <li><img src="{{ url('/') }}/img/linkedin-logo.png" alt="" width="100px" align="right"> &nbsp; </li>
                            <li><img src="{{ url('/') }}/img/logo-full.png" alt="" width="100px" align="right"> &nbsp; </li>
                            <li><img src="{{ url('/') }}/img/efritin-logo.png" alt="" width="100px" align="right"> &nbsp; </li>
                            <li><img src="{{ url('/') }}/img/job_informant.PNG" alt="" width="100px" align="right"> &nbsp; </li>
                          </ul>
                          <div class="clearfix"></div>
                          </div>

                          <div>

                            <h4 class="text-center"> Share this job!  <br>
                               <!-- <small>Because we want you to find the best talents.</small> -->
                           </h4>
                           <!-- <hr style="width: 45%"> -->
                           <p class="well">
                             {{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}
                           </p>
                            <ul class="list-inline">
                                 <li>
                                     <a href="https://www.facebook.com/sharer/sharer.php?u={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                             <span class="fa-stack fa-2x">
                                               <i class="fa fa-circle fa-stack-2x text-" style="color:#3b5998"></i>
                                               <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                             </span>
                                     </a>
                                 </li>
                                                                
                                 <li>
                                     <a href="https://twitter.com/home?status={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                             <span class="fa-stack fa-2x">
                                               <i class="fa fa-circle fa-stack-2x text-" style="color:#0084b4"></i>
                                               <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                             </span>
                                     </a>
                                 </li>
                                                                
                                 <li>
                                     <a href="https://plus.google.com/share?url={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                             <span class="fa-stack fa-2x">
                                               <i class="fa fa-circle fa-stack-2x text-" style="color:#007bb6"></i>
                                               <i class="fa fa-google fa-stack-1x fa-inverse"></i>
                                             </span>
                                     </a>
                                 </li>
                                  <li>
                                     <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                             <span class="fa-stack fa-2x">
                                               <i class="fa fa-circle fa-stack-2x text-" style="color:#007bb6"></i>
                                               <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                             </span>
                                     </a>
                                 </li>
                                 <!-- https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source= -->
                             </ul>
                          </div>
                            <a href="{{ url('my-jobs') }}" class="btn btn-primary">View My Jobs</a>
                            <!-- <a href="" class="btn btn-primary">Promote job on more job boards</a>
                            <a href="" class="btn btn-line">Upload CVs to this job</a> -->
                            <div class="clearfix"></div>
                          <br>
                          <!-- <p>
                            <a href="" class="btn btn-line">Upload CVs for this job <i class="fa fa-folder"></i></a>
                          </p> -->
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