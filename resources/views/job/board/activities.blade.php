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
                              <li role="cv-notifications" class="list-group-item">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                  <i class="fa fa-folder fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-info">CV Upload</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small> You uploaded 20 new resumes. <a href="cv/cv_saved">Go to saved resume</a>
                                </p>
                              </li>

                              <li role="job-notifications" class="list-group-item">

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

                              <li role="candidate-notifications" class="list-group-item">

                               <span class="fa-stack fa-lg i-notify">
                                  <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                  <i class="fa fa-user-plus fa-stack-1x fa-inverse"></i>
                                </span>

                                <h5 class="no-margin text-warning">Applications</h5>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small>2 new applicants for <a class="" href="jobs/dashboard">Brand Manager at Oando</a>. <a href="jobs/applicants">Go to job board</a>
                                </p>
                                <p>
                                    <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                    You closed 1  job openings. <a href="jobs/dashboard">View Job</a>
                                </p>
                              </li>

                              <li role="warning-notifications" class="list-group-item">

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
                        <p><a class="btn btn-line" href="">Action</a></p>

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