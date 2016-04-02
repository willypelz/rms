@extends('layout.template-user')

@section('content')


    <section class="no-pad">
        <div class="container">
        <section class="job-head blue">
            <div class="">
                <div class="row">
                
                    <div class="col-xs-7">
                
                        <h2 class="job-title">
                            <a href="#">
                                Brand Manager &amp; Creative Director in the very capital city of Abuja in the in Nigeria
                            </a>
                        </h2>
                        <hr>
                        <ul class="list-inline text-white">
                            <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                            <!-- <li>
                                <a href="create-job.php" class="btn btn-line btn-sm"><i class="fa fa-eye"></i> View Job</a>
                            </li> -->
                            <!-- <li>
                                <a href="create-job.php" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> Edit Job</a>
                            </li> -->
                            <li>
                                <strong>&nbsp;Posted:</strong>&nbsp; 07 Jun, 2014</li>
                            <li>
                                <strong>&nbsp;Expires:</strong>&nbsp; 21 Jun, 2014</li>
                        </ul>

                        <div class="label label-success" style="">Job is active</div> 

                        <div class="label label-warning" style="">Job is warning</div> 

                        <div class="label label-danger" style="">Job is in danger</div> <!-- <small>To change</small> -->
                
                        <!-- <div class="badge badge-job badge-job-active">
                            <small class="">
                                <span class="glyphicon glyphicon-ok"></span>
                                &nbsp; Job is active
                            </small>
                        </div> -->
                    </div>
                
                    <div class="col-xs-5 job-progress-xs">
                
                
                        <ul class="pagination pull-right job-progress">
                            <li><a href="#">New</a>
                            </li>
                            <li><a href="#">In Review</a>
                            </li>
                            <li><a href="#" class="active">Interview</a>
                            </li>
                            <li><a href="#">Assessed</a>
                            </li>
                            <li><a href="#">Filled</a>
                            </li>
                        </ul>
                
                        <!-- Select Job Status -->
                
                        <div class="btn-group btn-group-justified" role="group">
                            <div  class="btn-group" role="group">
                                <a href="{{ url('jobs/preview') }}" target="_blank" type="button" class="btn-sm btn btn-info status"><i class="fa fa-file-o"></i> &nbsp; Preview</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="{{ url('jobs/create') }}" type="button" class="btn-sm btn btn-info status"><i class="fa fa-pencil"></i> &nbsp; Edit Details</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="#" type="button" class="btn-sm btn btn-danger status"><i class="fa fa-ban"></i> &nbsp; Unpublish Job</a>
                            </div>
                        </div>
                
                
                    </div>
                
                
                        </div>
            </div>
        
        </section>
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                        <div class="btn-group btn-group-justified btn-tabs job-dash no-pad text-brandon" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="{{ url('jobs/dashboard') }}" type="button" class="btn btn-line text-capitalize text-muted in">
                            <span class="fa-lg"><i class="fa fa-send"></i>
                            <span class="hidden-xs"> &nbsp; Promote Job</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('jobs/activities') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities & Stats</span></span>
                            <!-- <small class="text-muted hidden-xs">Job Statistics</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('jobs/applicants') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-edit"></i>
                            <span class="hidden-xs"> &nbsp; <b>234</b> Applicants</span></span>
                            <!-- <small class="text-muted hidden-xs">See all applicants and their status </small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('jobs/team') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-users"></i>
                            <span class="hidden-xs"> &nbsp; Job Team</span></span>
                            <!-- <small class="text-muted hidden-xs">Resumes / CVs</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('jobs/matching') }}" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-user-md"></i>
                            <span class="hidden-xs"> &nbsp; Matching Candidates</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                        </div>
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
                                                <input type="checkbox" class="" autocomplete="off" checked="" disabled="">
                                                <span class="col-xs-6"><img src="https://insidify.com/desktop/img/logo.png" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>Insidify Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" checked="">
                                                <span class="col-xs-6"><img src="https://www.britishcouncil.org.ng/profiles/solas2/themes/britishcouncil/images/desktop/logo-british-council-color.png" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>Guargian Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" checked="">
                                                <span class="col-xs-6"><img src="http://www.jobberman.com/img/new/logo.png" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>Punch Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                          </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="">
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" checked="">
                                                <span class="col-xs-6"><img src="http://www.jobimu.com/wp-content/uploads/2014/07/cropped-jobimu-logo.jpg" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>Naij Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" checked="">
                                                <span class="col-xs-6"><img src="http://www.myjobmag.com/pics/logo6.png" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>My Job Mag</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" checked="">
                                                <span class="col-xs-6"><img src="http://www.hotnigerianjobs.com/images/banner2.gif" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>Hot Nigerian Jobs</b><br>www.insidify.com</span>
                                                <span class="clearfix"></span>
                                              </label>
                                          </div>
                                        </div>
                                        <div class="col-xs-12"><br>
                                            <a href="" class="pull-right btn btn-success">proceed</a>
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