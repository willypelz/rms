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
                            <a href="{{ url('jobs/dashboard') }}" type="button" class="btn btn-line text-capitalize text-muted">
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
                            <a href="{{ url('jobs/team') }}" type="button" class="btn btn-line text-capitalize in">
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
                        <div class="col-xs-7">
                            <h5 class="no-margin"> <!-- <i class="fa fa-lg fa-users"></i> --> Team members</h5><hr>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="col-xs-2"><img class="img-circle" src="img/avatar.jpg" alt="" width="100%"></div>
                                    <div class="col-xs-6">
                                        <h5>Rashid Davidson</h5>
                                        <p>rdavidson@expressdelivery.com</p>
                                    </div>
                                    <div class="col-xs-4 small"><br>
                                        <span class="pull-right"><a href="" class=""><i class="fa fa-pencil"></i> &nbsp; Edit</a> &nbsp; &middot; &nbsp;
                                            <a href="" class="text-muted"><i class="fa fa-close"></i> Remove</a></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <li class="list-group-item">
                                    <div class="col-xs-2"><img class="img-circle" src="img/avatar.jpg" alt="" width="100%"></div>
                                    <div class="col-xs-6">
                                        <h5>Anifowose Bashiru</h5>
                                        <p>aninibas@hpconsult.com</p>
                                    </div>
                                    <div class="col-xs-4 small"><br>
                                        <span class="pull-right"><a href="" class=""><i class="fa fa-pencil"></i> &nbsp; Edit</a> &nbsp; &middot; &nbsp;
                                            <a href="" class="text-muted"><i class="fa fa-close"></i> Remove</a></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>

                        </div>

                        <div class="col-xs-5">
                            <h5 class="no-margin">Add New Team member <span class="pull-right"><i class="fa fa-lg fa-user-plus"></i></span></h5><hr>

                            <a href="#AddTeamMember" data-target="#AddTeamMember"  data-toggle="collapse" class="btn btn-warning" aria-expanded="false" aria-controls="AddTeamMember"><i class="fa fa-user-plus"></i> Add New Member</a>

                            <div class="collapse" id="AddTeamMember">
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
                    </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection