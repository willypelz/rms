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
                                <a href="create-{{ URL::to('jobs/preview') }}" class="btn btn-line btn-sm"><i class="fa fa-eye"></i> View Job</a>
                            </li> -->
                            <!-- <li>
                                <a href="create-{{ URL::to('jobs/preview') }}" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> Edit Job</a>
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
                            <div class="btn-group" role="group">
                                <a href="" type="button" class="btn-sm btn btn-danger status"><i class="fa fa-ban"></i> Unpublish Job</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="{{ URL::to('jobs/preview') }}" target="_blank" type="button" class="btn-sm btn btn-success status"><i class="fa fa-file"></i> Preview</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="create-{{ URL::to('jobs/preview') }}" type="button" class="btn-sm btn btn-success status"><i class="fa fa-pencil"></i> Edit Details</a>
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


                        <div class="btn-group btn-group-justified btn-tabs no-pad" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="your-jobs.php" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities & Stats</span><br></span>
                            <small class="text-muted hidden-xs">Job Statistics</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="dashboard.php" type="button" class="btn btn-line text-capitalize in">
                            <span class="fa-lg"><i class="fa fa-users"></i>
                            <span class="hidden-xs"> &nbsp; Applicants</span><br></span>
                            <small class="text-muted hidden-xs">See all applicants and their status </small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="talen-pool.php" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-file-text"></i>
                            <span class="hidden-xs"> &nbsp; Job Team</span><br></span>
                            <small class="text-muted hidden-xs">Resumes / CVs</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="setting.php" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-cog"></i>
                            <span class="hidden-xs"> &nbsp; Job Settings</span><br></span>
                            <small class="text-muted hidden-xs">Edit your settings</small>
                            </a>
                          </div>
                        </div>
                            <div class="tab-content">

                        <div class="row">
                            

                                <div class="">
                                    <div class="col-xs-8">
                                    
                                        <h3 class="no-margin">
                                        Candidates that match this Job
                                        <i class="fa fa-users pull-right text-muted"></i>
                                        </h3>
                                        <small>This candidates are from Insidify.com</small>
                                        <hr>
                                    
                                        <div class="comment media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="{{ asset('img/avatar.jpg') }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>&nbsp; Do Something</a>

                                                <a href="" class="btn btn-sm btn-danger pull-right"><i class="fa fa-plus"></i>&nbsp; Add as applicant</a>
                                                <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                                </h5>
                                                <p>Teacher, Southgate College. Ikorodu</p>
                                                <small class="hidden">
                                                    <span class="text-muted">18 minutes ago</span>
                                                    &nbsp;
                                                    <a href="share.html" data-toggle="modal" data-target="#myModal">Share</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Review</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Assess</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Interview</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Reject</a>
                                    
                                                    <span class="pull-right">
                                                        <a href="#" class="text-muted">other items</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option1</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option2</a>
                                                    </span>
                                                </small>
                                    
                                    
                                    
                                            </div>
                                        </div>
                                    
                                        <hr>
                                    
                                    
                                        <div class="comment media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="{{ asset('img/avatar.jpg') }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>&nbsp; Do Something</a>

                                                <a href="" class="btn btn-sm btn-danger pull-right"><i class="fa fa-plus"></i>&nbsp; Add as applicant</a>
                                                <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                                </h5>
                                                <p>Teacher, Southgate College. Ikorodu</p>
                                                <small class="hidden">
                                                    <span class="text-muted">18 minutes ago</span>
                                                    &nbsp;
                                                    <a href="share.html" data-toggle="modal" data-target="#myModal">Share</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Review</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Assess</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Interview</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Reject</a>
                                    
                                                    <span class="pull-right">
                                                        <a href="#" class="text-muted">other items</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option1</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option2</a>
                                                    </span>
                                                </small>
                                    
                                    
                                    
                                            </div>
                                        </div>
                                    
                                        <hr>
                                    
                                    
                                        <div class="comment media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="{{ asset('img/avatar.jpg') }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>&nbsp; Do Something</a>

                                                <a href="" class="btn btn-sm btn-danger pull-right"><i class="fa fa-plus"></i>&nbsp; Add as applicant</a>
                                                <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                                </h5>
                                                <p>Teacher, Southgate College. Ikorodu</p>
                                                <small class="hidden">
                                                    <span class="text-muted">18 minutes ago</span>
                                                    &nbsp;
                                                    <a href="share.html" data-toggle="modal" data-target="#myModal">Share</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Review</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Assess</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Interview</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Reject</a>
                                    
                                                    <span class="pull-right">
                                                        <a href="#" class="text-muted">other items</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option1</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option2</a>
                                                    </span>
                                                </small>
                                    
                                    
                                    
                                            </div>
                                        </div>
                                    
                                        <hr>
                                    
                                    
                                        <div class="comment media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="{{ asset('img/avatar.jpg') }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>&nbsp; Do Something</a>

                                                <a href="" class="btn btn-sm btn-danger pull-right"><i class="fa fa-plus"></i>&nbsp; Add as applicant</a>
                                                <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                                </h5>
                                                <p>Teacher, Southgate College. Ikorodu</p>
                                                <small class="hidden">
                                                    <span class="text-muted">18 minutes ago</span>
                                                    &nbsp;
                                                    <a href="share.html" data-toggle="modal" data-target="#myModal">Share</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Review</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Assess</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Interview</a>
                                                    <span class="text-muted">·</span>
                                                    <a href="#">Reject</a>
                                    
                                                    <span class="pull-right">
                                                        <a href="#" class="text-muted">other items</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option1</a>
                                                        <span class="text-muted">·</span>
                                                        <a href="#" class="text-muted">option2</a>
                                                    </span>
                                                </small>
                                    
                                    
                                    
                                            </div>
                                        </div>
                                    
                                        <hr>
                                    
                                        <div class="comment media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="{{ asset('img/avatar.jpg') }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <a href="" class="btn btn-sm btn-line pull-right">
                                                    <i class="fa fa-bars"></i> Do Something
                                                    <!-- <i class="fa fa-check"></i> Remove -->

                                                </a>
                                                <a href="" class="btn btn-sm btn-line pull-right">
                                                    <i class="fa fa-check"></i> Added
                                                    <!-- <i class="fa fa-check"></i> Remove -->

                                                </a>
                                                <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                                </h5>
                                                <p>Teacher, Southgate College. Ikorodu</p>
                                    
                                            </div>
                                        </div>

                                        <h5 class="no-margin text-center"><hr>
                                            <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                                            Searching for candidates that match this Job
                                        </h5>
                                    
                                        <a href="" class="btn btn-line btn-block load">
                                            <span class="glyphicon glyphicon-repeat"></span>&nbsp; See more</a>
                                    </div>
                                    
                                    
                                    <!-- End of Applicant Section -->
                                    
                                    <div class="col-xs-4 filter-div">
                                        <div class="">
                                            <h4 class="panel-title">Filter Candidate List By :</h4>
                                            <hr>
                                        </div>
                                        <form>
                                            <div class="">
                                                <p class="text-success">Gender</p>
                                                <div class="input-group">
                                                    <div class="checkbox-inline">
                                                        <label>
                                                            <input type="checkbox" class="">Male (23)</label>
                                                        <br>
                                                        <label>
                                                            <input type="checkbox" class="">Female (45)</label>
                                                    </div>
                                    
                                                </div>
                                                <!-- /input-group -->
                                                <hr>
                                    
                                                <p class="text-success">Age Range</p>
                                                <div class="input-group ">
                                                    <span class="">From
                                                        <input class="filter-input-text small-input" type="text">
                                                    </span>
                                    
                                                    <span class="">to
                                                        <input class="filter-input-text small-input" type="text">years
                                                    </span>
                                    
                                    
                                    
                                                    <div class="checkbox-inline">
                                                        <br>
                                                        <label>
                                                            <input type="checkbox" class="">21 - 30 years (23)</label>
                                                        <br>
                                                        <label>
                                                            <input type="checkbox" class="">31 - 40 years (45)</label>
                                                        <br>
                                                        <label>
                                                            <input type="checkbox" class="">41 - 50 years (45)</label>
                                                        <br>
                                                    </div>
                                    
                                                    <div>
                                                        <small class="">&nbsp; <a href="">See More</a>
                                                        </small>
                                                    </div>
                                    
                                                </div>
                                                <!-- /input-group -->
                                                <hr>
                                    
                                                <p class="text-success">Location</p>
                                                <!--<div class="input-group">-->
                                                <!--<select>-->
                                                <!--<option selected >Not Specified</option>-->
                                                <!--</select>-->
                                    
                                                <!--<small class="">&nbsp; <a href="">+ Add another Location</a></small>-->
                                                <div class="checkbox-inline">
                                                    <label>
                                                        <input type="checkbox" class="">Lagos</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Abuja</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Ife City</label>
                                                    <br>
                                                </div>
                                    
                                                <div>
                                                    <small class="">&nbsp; <a href="">See More</a>
                                                    </small>
                                                </div>
                                                <!--</div> /input-group -->
                                    
                                                <hr>
                                    
                                                <p class="text-success">Company</p>
                                                <!--<div class="input-group">-->
                                                <!--<select>-->
                                                <!--<option selected >Not Specified</option>-->
                                                <!--</select>-->
                                    
                                                <!--<small class="">&nbsp; <a href="">+ Add another Location</a></small>-->
                                                <div class="checkbox-inline">
                                                    <label>
                                                        <input type="checkbox" class="">Idumota LEKO</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Waressence LTD</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Jobberman</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Country Kitchen</label>
                                                    <br>
                                                    <label>
                                                        <input type="checkbox" class="">Carnegie Petroleum Trust Fund, Abuja</label>
                                                    <br>
                                                </div>
                                    
                                                <div>
                                                    <small class="">&nbsp; <a href="">See All</a>
                                                    </small>
                                                </div>
                                                <!--</div> /input-group -->
                                    
                                                <br>
                                    
                                    
                                            </div>
                                        </form>
                                    </div>
<!--                                     <div class="col-xs-4 col-xs-offset-4"><hr>
                                        <a href="job-board.php" class="btn btn-block btn-primary">Proceed to Job Dashboard &raquo;</a>
                                    </div> -->
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