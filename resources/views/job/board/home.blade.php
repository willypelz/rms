@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
   
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
                                    <h3 class="panel-title">Advertise on Job Boards</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem distinctio incidunt voluptas!</p>
                                            </div>
                                            <div class="col-xs-12">
                                                <br>
                                            </div>
                                        <div class="col-xs-6">
                                            <div class="">
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left disabled">
                                                <input type="checkbox" disabled="" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="https://insidify.com/desktop/img/logo.png"></span>
                                                <span class="col-xs-6"><b>Insidify Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="https://www.britishcouncil.org.ng/profiles/solas2/themes/britishcouncil/images/desktop/logo-british-council-color.png"></span>
                                                <span class="col-xs-6"><b>Guargian Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="http://www.jobberman.com/img/new/logo.png"></span>
                                                <span class="col-xs-6"><b>Punch Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                          </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="">
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="http://www.jobimu.com/wp-content/uploads/2014/07/cropped-jobimu-logo.jpg"></span>
                                                <span class="col-xs-6"><b>Naij Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="http://www.myjobmag.com/pics/logo6.png"></span>
                                                <span class="col-xs-6"><b>My Job Mag</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" checked="" autocomplete="off" class="">
                                                <span class="col-xs-6"><img width="100%" alt="" src="http://www.hotnigerianjobs.com/images/banner2.gif"></span>
                                                <span class="col-xs-6"><b>Hot Nigerian Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                          </div>
                                        </div>
                                        <div class="col-xs-12"><br>
                                            <a class="pull-right btn btn-success" href="">proceed</a>
                                        </div>
                                        <div class="clearfix"></div>

                                        </div>

                                    </div>
                                  </div>
                                </div>

                            </div>

                            <div class="col-xs-4">

                                <div class="panel panel-default">
                                
                                  <div class="panel-heading">
                                    <h3 class="panel-title text-center">Share on Social Media</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="text-center">
                                   <p class="">Share this job publishing on LinkedIn, Twitter, Facebook.</p><br>
                               
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
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection