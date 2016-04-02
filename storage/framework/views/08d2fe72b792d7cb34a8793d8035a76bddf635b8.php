<?php $__env->startSection('content'); ?>


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
                                <a href="<?php echo e(url('jobs/preview')); ?>" target="_blank" type="button" class="btn-sm btn btn-info status"><i class="fa fa-file-o"></i> &nbsp; Preview</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="<?php echo e(url('jobs/create')); ?>" type="button" class="btn-sm btn btn-info status"><i class="fa fa-pencil"></i> &nbsp; Edit Details</a>
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
                            <a href="<?php echo e(url('jobs/dashboard')); ?>" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-cog"></i>
                            <span class="hidden-xs"> &nbsp; Promote Job</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="<?php echo e(url('jobs/activities')); ?>" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities & Stats</span></span>
                            <!-- <small class="text-muted hidden-xs">Job Statistics</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="<?php echo e(url('jobs/applicants')); ?>" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-edit"></i>
                            <span class="hidden-xs"> &nbsp; Applicants</span></span>
                            <!-- <small class="text-muted hidden-xs">See all applicants and their status </small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="<?php echo e(url('jobs/team')); ?>" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-users"></i>
                            <span class="hidden-xs"> &nbsp; Job Team</span></span>
                            <!-- <small class="text-muted hidden-xs">Resumes / CVs</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="<?php echo e(url('jobs/matching')); ?>" type="button" class="btn btn-line text-capitalize text-muted in">
                            <span class="fa-lg"><i class="fa fa-user-md"></i>
                            <span class="hidden-xs"> &nbsp; Matching Candidates</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="text-center text-success text-brandon">45 Candidates match this job from our database</h5>
                            </div>
                        </div>

                        <div class="tab-content">               
                        <!-- matching -->

                                <div class="row">

                                    <div class="col-sm-8">

                                          <div class="" id="search-results">

                                            <ul class="search-results">
                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a class="" href="my-cv.html">
                                                            <img class="media-object job-team-img" width="100%" src="img/avatar-cv.jpg" alt="">
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
                                                                <div class="btn-group">
                                                                  <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li role="separator" class="divider"></li>

                                                                    <li>
                                                                        <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                                  <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              </p>
                                                            </div>
                                                    </span>

                                              </li><hr>
                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a class="" href="my-cv.html">
                                                            <img class="media-object job-team-img" width="100%" src="img/avatar-cv.jpg" alt="">
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
                                                                <div class="btn-group">
                                                                  <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li role="separator" class="divider"></li>

                                                                    <li>
                                                                        <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                                  <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              </p>
                                                            </div>
                                                    </span>

                                              </li><hr>

                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a class="" href="my-cv.html">
                                                            <img class="media-object job-team-img" width="100%" src="img/avatar-cv.jpg" alt="">
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
                                                                <div class="btn-group">
                                                                  <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li role="separator" class="divider"></li>

                                                                    <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                                                                  </ul>
                                                                </div>
                                                                  <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              </p>
                                                            </div>
                                                    </span>

                                              </li><hr>

                                              <li class="row">
                                                    <span class="col-md-2 col-sm-3">
                                                        <a class="" href="my-cv.html">
                                                            <img class="media-object job-team-img" width="100%" src="img/avatar-cv.jpg" alt="">
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
                                                                <div class="btn-group">
                                                                  <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Save into Folder &nbsp; <span class="caret"></span>
                                                                  </button>
                                                                  <ul class="dropdown-menu">
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                                    <li role="separator" class="divider"></li>

                                                                    <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                                                                  </ul>
                                                                </div>
                                                                  <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                                                  <span class="purchase-action">
                                                                        <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                                      <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                                </span>

                                                              </p>
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

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group text-right">
                                                <a data-toggle="modal" data-target="#myInvoice" href="#" target="_blank" type="submit" class="btn btn-danger disabled btn-cart-checkout">Proceed to payment &raquo;</a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>