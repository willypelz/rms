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
                                    <label data-toggle="collapse" aria-controls="h_act-on" aria-expanded="false" data-target="#h_act-on" role="button" class="select-all pull-right">Select All
                                       <input type="checkbox">
                                   </label>
                               </div>

                                <div id="h_act-on" class="col-xs-12 collapse app-action">
                                    <div>
                                        <div class="btn-group select-action">
                                            <button class="btn btn-default status-1" type="button">Reject All</button>
                                            <button class="btn btn-default status-1" type="button">Message All</button>
                                            <button class="btn btn-default status-1" type="button">Assess All</button>
                                        </div>
                                        
                                        <div class="btn-group select-action">
                                            <button class="btn btn-default status-1" type="button">Mark as Reviewed</button>
                                            <button class="btn btn-default status-1" type="button">Mark as Interviewed</button>
                                            <button class="btn btn-default status-1" type="button">Mark as Hired</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <hr>

                            <div class="comment media">
                                <a href="#" class="pull-left">
                                    <img alt="" src="img/avatar.jpg" class="media-object">
                                </a>
                                <div class="media-body">
                                    <input type="checkbox" class="media-body-check pull-right">
                                    <h4 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h4>
                                    <p>Teacher, Southgate College. Ikorodu</p>
                                    <small>
                                        <span class="text-muted">18 minutes ago</span>
                                        &nbsp;
                                        <a data-target="#myModal" data-toggle="modal" href="share.html">Share</a>
                                        <span class="text-muted">·</span>
                                        <a href="#">Review</a>
                                        <span class="text-muted">·</span>
                                        <a href="#">Assess</a>
                                        <span class="text-muted">·</span>
                                        <a href="#">Interview</a>
                                        <span class="text-muted">·</span>
                                        <a href="#">Reject</a>

                                        <span class="pull-right">
                                            <a class="text-muted" href="#">other items</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option1</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option2</a>
                                        </span>
                                    </small>



                                </div>
                            </div>

                            <hr>

                            <div class="comment media">
                                <a href="#" class="pull-left">
                                    <img alt="" src="img/avatar.jpg" class="media-object">
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
                                            <a class="text-muted" href="#">other items</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option1</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option2</a>
                                        </span>
                                    </small>

                                </div>
                            </div>

                            <hr>

                            <div class="comment media">
                                <a href="#" class="pull-left">
                                    <img alt="" src="img/avatar.jpg" class="media-object">
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
                                            <a class="text-muted" href="#">other items</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option1</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option2</a>
                                        </span>
                                    </small>

                                </div>
                            </div>

                            <hr>

                            <div class="comment media">
                                <a href="#" class="pull-left">
                                    <img alt="" src="img/avatar.jpg" class="media-object">
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
                                            <a class="text-muted" href="#">other items</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option1</a>
                                            <span class="text-muted">·</span>
                                            <a class="text-muted" href="#">option2</a>
                                        </span>
                                    </small>

                                </div>
                            </div>


                            <a class="btn btn-line btn-block load" href="">
                                <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a>
                        </div>

                        <!-- Filter -->

                        <div class="col-sm-4">
                            <div class="well well-cart animated slideInUp collapse fixer" id="collapseWellCart">
                                <div class="row">
                                    <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                                          <i class="fa fa-shopping-cart fa-3x"></i>
                                        
                                    </div>
                                    <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                                        <span id="item-count">
                                                <span style="display: inline-block;" class="bounceInDown fa-2x">0</span>
                                        </span>
                                    </div>
                                    <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                                        <span class="pull-right fa-2x">
                                            ₦ 
                                            <span id="price-total">0</span> 
                                        </span>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="col-xs-6"><a class="btn btn-block btn-danger btn-sm btn-cart-checkout" data-target="#myInvoice" data-toggle="modal" target="_blank" href="#"> Checkout »</a></div>
                                    <div class="col-xs-6"><button class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                                </div>
                            </div>
                          <div id="accordion" class="filter-div panel-group">


                              <div style="border-width: 3px" class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                                      Filter Result here
                                    </a>
                                    <a class="pull-right" href="#collapseOne" data-parent="#accordion" data-toggle="collapse"><img src="img/up.png"></a>
                                  </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseOne">
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

                            <div><a class="more-link read-more-show hide" href="#"><small>See More</small></a>
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
                                    <a class="less-link read-more-hide hide" href="#"><small>Less</small></a>
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
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection