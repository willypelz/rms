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
                            <a href="{{ url('activities') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities & Stats</span></span>
                            <!-- <small class="text-muted hidden-xs">Job Statistics</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('applicants') }}" type="button" class="btn btn-line text-capitalize in">
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
                            <div class="col-xs-8 ">
                            <div class="row">
                                <div class="col-xs-10">
                                    <ul class="nav nav-pills option-aps">
                                        <li class="active"><a href="#">All <span class="badge">12</span></a>
                                        </li>
                                        <li><a href="#">In Review</a>
                                        </li>
                                        <li><a href="#">Assessed <span class="badge">3</span></a>
                                        </li>
                                        <li><a href="#">Interviewed</a>
                                        </li>
                                        <li><a href="#">Hired <span class="badge">1</span></a>
                                        </li>
                                        <li><a href="#">Rejected <span class="badge">3</span></a>
                                        </li>
                                    </ul><br>
                                <small class="text-muted">Showing 12 of 234 apllicants</small>
                                </div>

                               <div class="col-xs-2">
                                    <label class="select-all pull-right" role="button" data-target="#h_act-on" aria-expanded="false" aria-controls="h_act-on"  data-toggle="collapse">Select All
                                       <input type="checkbox">
                                   </label>
                               </div>

                                <div class="col-xs-12 collapse app-action" id="h_act-on">
                                    <div>
                                        <div class="btn-group select-action">
                                            <button type="button" class="btn btn-default status-1">Reject All</button>
                                            <button type="button" class="btn btn-default status-1">Message All</button>
                                            <button type="button" class="btn btn-default status-1">Assess All</button>
                                        </div>
                                        
                                        <div class="btn-group select-action">
                                            <button type="button" class="btn btn-default status-1">Mark as Reviewed</button>
                                            <button type="button" class="btn btn-default status-1">Mark as Interviewed</button>
                                            <button type="button" class="btn btn-default status-1">Mark as Hired</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <hr>

                            <div class="comment media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="img/avatar.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <input type="checkbox" class="media-body-check pull-right">
                                    <h4 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h4>
                                    <p>Teacher, Southgate College. Ikorodu</p>
                                    <small>
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
                                    <img class="media-object" src="img/avatar.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <input type="checkbox" class="media-body-check pull-right">
                                    <h4 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h4>
                                    <p>Teacher, Southgate College. Ikorodu</p>
                                    <small>
                                        <span class="text-muted">18 minutes ago</span>
                                        &nbsp;
                                        <a href="#">Share</a>
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
                                    <img class="media-object" src="img/avatar.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <input type="checkbox" class="media-body-check pull-right">
                                    <h4 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h4>
                                    <p>Teacher, Southgate College. Ikorodu</p>
                                    <small>
                                        <span class="text-muted">18 minutes ago</span>
                                        &nbsp;
                                        <a href="#">Share</a>
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
                                    <img class="media-object" src="img/avatar.jpg" alt="">
                                </a>
                                <div class="media-body">
                                    <input type="checkbox" class="media-body-check pull-right">
                                    <h4 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h4>
                                    <p>Teacher, Southgate College. Ikorodu</p>
                                    <small>
                                        <span class="text-muted">18 minutes ago</span>
                                        &nbsp;
                                        <a href="#">Share</a>
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


                            <a href="" class="btn btn-line btn-block load">
                                <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a>
                        </div>

                        <!-- Filter -->

                        <div class="col-sm-4">
                            <div id="collapseWellCart" class="well well-cart animated slideInUp collapse">
                                <div class="row">
                                    <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                                          <i class="fa fa-shopping-cart fa-3x"></i>
                                        </span>
                                    </div>
                                    <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                                        <span id="item-count">
                                                <span class="bounceInDown fa-2x" style="display: inline-block;">0</span>
                                        </span>
                                    </div>
                                    <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                                        <span class="pull-right fa-2x">
                                            &#8358; 
                                            <span id="price-total" >0</span> 
                                        </span>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="col-xs-6"><a href="#" target="_blank" data-toggle="modal" data-target="#myInvoice" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                                    <div class="col-xs-6"><button class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                                </div>
                            </div>
                          <div class="filter-div panel-group" id="accordion">


                              <div class="panel panel-default" style="border-width: 3px">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                      Filter Result here
                                    </a>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="pull-right"><img src="img/up.png"></a>
                                  </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                      <p class="border-bottom-thin text-muted">Gender<i class="glyphicon glyphicon-user pull-right"></i></p>
                                      <div class="checkbox-inline">
                                          <label class="normal"><input type="checkbox" class=""> Male</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Female</label> <br>
                                      </div>

                                      <p>--</p>

                                    <p class="border-bottom-thin text-muted">Location<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                                      <div class="checkbox-inline">
                                          <label class="normal"><input type="checkbox" class=""> Lagos</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Abuja</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Ife City</label> <br>
                                      </div>
                                      <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->

                            <div><a href="#" class="more-link read-more-show hide"><small>See More</small></a>
                                <div class="read-more-content checkbox-inline">
                                    <label class="normal">
                                        <input type="checkbox" class="">Lagos</label>
                                    <br>
                                    <label class="normal">
                                        <input type="checkbox" class="">Abuja</label>
                                    <br>
                                    <label class="normal">
                                        <input type="checkbox" class="">Ife City</label>
                                    <br>
                                    <a href="#" class="less-link read-more-hide hide"><small>Less</small></a>
                                </div>
                            </div>


                                      <p>--</p>

                                    <p class="border-bottom-thin text-muted">Company<i class="glyphicon glyphicon-briefcase pull-right"></i></p>
                                      <div class="checkbox-inline">
                                          <label class="normal"><input type="checkbox" class=""> Administrator</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Creative Director</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Head Officer</label> <br>
                                      </div>
                                      <div><small class="">&nbsp; <a href="">See More</a></small></div>

                            
                                      <p>--</p>

                                      <p class="border-bottom-thin text-muted">Job Type<i class="glyphicon glyphicon-paperclip pull-right"></i></p>
                                      <div class="checkbox-inline">
                                          <label class="normal"><input type="checkbox" class=""> Corporate</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Assistant</label> <br>
                                          <label class="normal"><input type="checkbox" class=""> Officer</label> <br>
                                      </div>
                                      <div><small class="">&nbsp; <a href="">See More</a></small></div>
                            
                                      <p>--</p>
                                      <p class="border-bottom-thin text-muted">Age Group<i class="glyphicon glyphicon-pushpin pull-right"></i></p>

                                  </div>
                                </div>
                              </div>

                            </div>

                            </div> <!--/col-sm-3-->
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