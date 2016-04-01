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
                                <a href="job.php" target="_blank" type="button" class="btn-sm btn btn-info status"><i class="fa fa-send"></i> &nbsp; Advertise</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="create-job.php" type="button" class="btn-sm btn btn-info status"><i class="fa fa-pencil"></i> &nbsp; Edit Details</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="" type="button" class="btn-sm btn btn-danger status"><i class="fa fa-ban"></i> &nbsp; Unpublish Job</a>
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
                            <a href="{{ url('jobs/dashboard') }}" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-send"></i>
                            <span class="hidden-xs"> &nbsp; Promote Job</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('activities') }}" type="button" class="btn btn-line text-capitalize in">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities & Stats</span></span>
                            <!-- <small class="text-muted hidden-xs">Job Statistics</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('applicants') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-edit"></i>
                            <span class="hidden-xs"> &nbsp; <b>234</b> Applicants</span></span>
                            <!-- <small class="text-muted hidden-xs">See all applicants and their status </small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('team') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-users"></i>
                            <span class="hidden-xs"> &nbsp; Job Team</span></span>
                            <!-- <small class="text-muted hidden-xs">Resumes / CVs</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('matching') }}" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-user-md"></i>
                            <span class="hidden-xs"> &nbsp; Matching Candidates</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                        </div>
                            <div class="tab-content">

                        <div class="row">                           
                        <!-- applicant -->


                <div class="col-xs-7">


                        <div class="row">
                        <h6 class="no-margin">
                            <span class="text-brandon text-uppercase">
                            Your Activities: 4 new updates 
                            </span> 
                            <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span>
                        </h6>
                        <div class="clearfix"><hr></div>

                            <ul class="list-group list-notify">
                              <li class="list-group-item" role="cv-notifications">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                  <i class="fa fa-folder fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-info">CV Upload</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small> You uploaded 20 new resumes. <a href="cv/cv_saved">Go to saved resume</a>
                                </p>
                              </li>

                              <li class="list-group-item" role="job-notifications">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-success"></i>
                                  <i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-success">Jobs</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small> You created 2 new job openings. <a href="jobs/list">Go to job list</a>
                                </p>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small> You closed 1  job openings. <a href="jobs/dashboard">View Job</a>
                                </p>
                              </li>

                              <li class="list-group-item" role="candidate-notifications">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                  <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-warning">Applications</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small>2 new applicants for <a href="jobs/dashboard" class="">Brand Manager at Oando</a>. <a href="jobs/applicants">Go to job board</a>
                                </p>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                    You closed 1  job openings. <a href="jobs/dashboard">View Job</a>
                                </p>
                              </li>

                              <li class="list-group-item" role="warning-notifications">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                  <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-danger">Warnings</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                    You haveYou have not performed <a href=""> this important task</a>
                                </p>
                              </li>

                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    <!--/tab-content-->

                </div>

                <div class="col-xs-4 col-xs-push-1">
                    <div class="">
                        
                        <h6 class="no-margin pull-right">
                            <span class="text-danger text-brandon text-uppercase">Your Statistics:</span> 
                        </h6>

                        <div class="separator separator-small"></div>

                        <table class="table table-bordered"> 
                        <tbody> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="jos/list">34</a></h1><small class="text-muted">Jobs Created</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">12,234</a></h1><small class="text-muted">Candidates</small></td> 
                        </tr> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-muted">24</h1><small class="text-muted">Jobs Closed</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">13,234</a></h1><small class="text-muted">Resumes</small></td> 
                        </tr>
                        </tbody> </table>

                        <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ex voluptatem dicta, minima iste magni, eligendi deserunt repellat nesciunt repellendus dolores illo possimus voluptas sit ratione harum libero odio perferendis.</p>
                        <p><a href="" class="btn btn-line">Action</a></p>

                    </div>
                </div>

                                
                        </div>

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