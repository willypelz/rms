@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
            @if($job['status'] != 'DELETED')
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                            @include('job.board.job-board-tabs')
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="text-center text-success text-brandon">This feauture is only available to premium users</h5>
                            </div>
                        </div>


                        <div class="tab-content hide">               
                        <!-- matching -->

                                <div class="row">

                                    <div class="col-sm-8">

                                          <div id="search-results" class="">

                                            <ul class="search-results">
                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a href="my-cv.html" class="">
                                                            <img width="100%" alt="" src="img/avatar-cv.jpg" class="media-object job-team-img">
                                                        </a>
                                                    </span>

                                                    <span class="col-md-10 col-sm-9">
                                                            <h4 class="text-muted">
                                                            <a href="my-cv.html">Obasanjo O. Akeem</a> .
                                                                <span class="small">26 yrs old .   Apapa, Lagos</span>
                                                                <!--<span class="label label-primary">INSIDIFY</span>-->
                                                            </h4>
                                                            <span>Trainee Software Developer- Java - <b>Zippro Systems</b></span>

                                                            <div class="description">
                                                                <p class="sub-box excerpt-p text-muted">bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</p>

                                                              <p class="">
                                                                    <!-- Single button -->
                                                                </p><div class="btn-group">
                                                                  <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-line btn-sm dropdown-toggle" type="button">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li class="divider" role="separator"></li>

                                                                    <li>
                                                                        <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                                  <a data-target="#cvViewModal" data-toggle="modal" class="btn btn-line btn-sm" href="cv.html">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a data-cost="500" data-count="1" class="btn btn-success btn-sm btn-cv-buy" href=""><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button data-cost="500" data-count="1" class="btn btn-line btn-sm btn-cv-discard collapse"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              <p></p>
                                                            </div>
                                                    </span>

                                              </li><hr>
                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a href="my-cv.html" class="">
                                                            <img width="100%" alt="" src="img/avatar-cv.jpg" class="media-object job-team-img">
                                                        </a>
                                                    </span>

                                                    <span class="col-md-10 col-sm-9">
                                                            <h4 class="text-muted">
                                                            <a href="my-cv.html">Obasanjo O. Akeem</a> .
                                                                <span class="small">26 yrs old .   Apapa, Lagos</span>
                                                                <!--<span class="label label-primary">INSIDIFY</span>-->
                                                            </h4>
                                                            <span>Trainee Software Developer- Java - <b>Zippro Systems</b></span>

                                                            <div class="description">
                                                                <p class="sub-box excerpt-p text-muted">bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</p>

                                                              <p class="">
                                                                    <!-- Single button -->
                                                                </p><div class="btn-group">
                                                                  <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-line btn-sm dropdown-toggle" type="button">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li class="divider" role="separator"></li>

                                                                    <li>
                                                                        <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                                  <a data-target="#cvViewModal" data-toggle="modal" class="btn btn-line btn-sm" href="cv.html">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a data-cost="500" data-count="1" class="btn btn-success btn-sm btn-cv-buy" href=""><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button data-cost="500" data-count="1" class="btn btn-line btn-sm btn-cv-discard collapse"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              <p></p>
                                                            </div>
                                                    </span>

                                              </li><hr>

                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a href="my-cv.html" class="">
                                                            <img width="100%" alt="" src="img/avatar-cv.jpg" class="media-object job-team-img">
                                                        </a>
                                                    </span>

                                                    <span class="col-md-10 col-sm-9">
                                                            <h4 class="text-muted">
                                                            <a href="my-cv.html">Obasanjo O. Akeem</a> .
                                                                <span class="small">26 yrs old .   Apapa, Lagos</span>
                                                                <!--<span class="label label-primary">INSIDIFY</span>-->
                                                            </h4>
                                                            <span>Trainee Software Developer- Java - <b>Zippro Systems</b></span>

                                                            <div class="description">
                                                                <p class="sub-box excerpt-p text-muted hidden"><i>bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</i></p>
                                                                <br>
                                                              <p class="">
                                                                    <!-- Single button -->
                                                                </p><div class="btn-group">
                                                                  <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-line btn-sm dropdown-toggle" type="button">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li class="divider" role="separator"></li>

                                                                    <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                                                                  </ul>
                                                                </div>
                                                                  <a data-target="#cvViewModal" data-toggle="modal" class="btn btn-line btn-sm" href="cv.html">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a data-cost="500" data-count="1" class="btn btn-success btn-sm btn-cv-buy" href=""><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button data-cost="500" data-count="1" class="btn btn-line btn-sm btn-cv-discard collapse"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              <p></p>
                                                            </div>
                                                    </span>

                                              </li><hr>

                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a href="my-cv.html" class="">
                                                            <img width="100%" alt="" src="img/avatar-cv.jpg" class="media-object job-team-img">
                                                        </a>
                                                    </span>

                                                    <span class="col-md-10 col-sm-9">
                                                            <h4 class="text-muted">
                                                            <a href="my-cv.html">Obasanjo O. Akeem</a> .
                                                                <span class="small">26 yrs old .   Apapa, Lagos</span>
                                                                <!--<span class="label label-primary">INSIDIFY</span>-->
                                                            </h4>
                                                            <span>Trainee Software Developer- Java - <b>Zippro Systems</b></span>

                                                            <div class="description">
                                                                <p class="sub-box excerpt-p text-muted hidden"><i>bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</i></p>
                                                                <br>
                                                              <p class="">
                                                                    <!-- Single button -->
                                                                </p><div class="btn-group">
                                                                  <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-line btn-sm dropdown-toggle" type="button">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li class="divider" role="separator"></li>

                                                                    <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                                                                  </ul>
                                                                </div>
                                                                  <a data-target="#cvViewModal" data-toggle="modal" class="btn btn-line btn-sm" href="cv.html">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a data-cost="500" data-count="1" class="btn btn-success btn-sm btn-cv-buy" href=""><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button data-cost="500" data-count="1" class="btn btn-line btn-sm btn-cv-discard collapse"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              <p></p>
                                                            </div>
                                                    </span>

                                              </li><hr>
                                              <li class="row">
                                                <div class="text-center text-muted">
                                                <i class="fa fa-frown-o fa-3x"></i>
                                                  <h3>Not Found. Please Search again.</h3>
                                                </div>
                                              </li>


                                            </ul>

                                      </div> <!--/tab-content-->

                                    </div>
                                    <!-- End of col-9 -->

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

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group text-right">
                                                <a class="btn btn-danger disabled btn-cart-checkout" type="submit" target="_blank" href="#" data-target="#myInvoice" data-toggle="modal">Proceed to payment »</a>
                                            </div>
                                        </div>
                                    </div>

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