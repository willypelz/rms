@extends('layout.template-user')

@section('content')



    <section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-sm-4">
                    <div class=""><br>
                        <h4 class="text-green-light text-brandon"> <i class="fa fa-street-view"></i> 
                          Talent Pool
                          <small class="text-white">(All Candidates)</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-5">
                    <form id="form-cv-search" action="cv-search.php" class="form-group collapse"><br>
                       <div class="form-lg">
                         <div class="col-xs-10">
                           <div class="row"><input placeholder="Find something you want" value="Frontend Developer" class="form-control input-lg input-talent" type="text"></div>
                         </div>
                         <div class="col-xs-2">
                           <div class="row">
                               <button type="submit" class="btn btn-lg btn-block btn-success btn-talent">
                               <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                               <i class="fa fa-search fa-lg"></i>
                               </button>
                           </div>
                         </div>
                       </div>

                    <a href="#form-cv-search" data-toggle="collapse" aria-expanded="false" aria-controls="form-cv-search" class="pull-right" style=""><i class="fa fa-close fa-inverse"></i></a>

                    </form><br>
                    <a href="#form-cv-search" data-toggle="collapse" aria-expanded="false" aria-controls="form-cv-search" class="btn btn-success pull-right"><i class="fa fa-search-plus"></i> Find New Candidate</a>
                </div>
                    <div class="col-xs-3"><br>
                      <div class="dropdown">
                        <a href="" class="btn btn-block btn-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cloud-upload"></i> Upload CV to Folder &nbsp; <i class="fa fa-caret-down"></i></a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Medical</a></li>
                                <li><a href="#">Designers</a></li>
                                <li><a href="#">Expatriate </a></li>
                              </ul>
                      </div>
                    </div>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="content rounded ">
                    <div class="row">
                      <div class="well well-sm pushup-sm no-shadow">       
                      <!-- Single button -->
                        <div class="col-xs-6"> 
                      <span class="text-brandon"><i class="fa fa-bars"></i> sort by &nbsp;</span>                 
                            <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Date &nbsp; <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Medical</a></li>
                                <li><a href="#">Designers</a></li>
                                <li><a href="#">Expatriate </a></li>
                              </ul>
                            </div>
                          </div>
                        <div class="col-xs-6">
                        <form action="" class="form-inline pull-right">
                          <input type="text" class="form-control" placeholder="Search entire candidates" style="width:350px">
                        </form>                      
                        </div> 
                          <div class="clearfix"></div>
                      </div>
                    </div>

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
                                              <span class="small">26 yrs old .   Apapa, Lagos</span><br>
                                              <!--<span class="label label-primary">INSIDIFY</span>-->
                                          <small>Trainee Software Developer- Java - <b>Zippro Systems</b></small>
                                          </h4>

                                          <div class="description">

                                            <p class="">
                                            <span class="details-small">
                                              <span class="small text-success no-margin pull-right">Uploaded Thu 12-03-16</span>
                                               <span class="small text-muted"><i class="fa fa-folder"></i> Saved to Developers</span>
                                            </span>
                                                  <!-- Single button -->
                                              <div class="btn-group">
                                                <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Change Folder &nbsp; <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers &nbsp; <i class="fa fa-check"></i></a></a></li>
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
                                              <a href="" class="btn btn-sm btn-line pull-right" title="Delete CV"><i class="fa fa-trash no-margin"></i></a>
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
                                              <span class="small">26 yrs old .   Apapa, Lagos</span><br>
                                              <!--<span class="label label-primary">INSIDIFY</span>-->
                                          <small>Trainee Software Developer- Java - <b>Zippro Systems</b></small>
                                          </h4>

                                          <div class="description">

                                            <p class="">
                                            <span class="details-small">
                                              <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span>
                                              <span class="small text-muted"><i class="fa fa-close"></i> Not saved to Folder</span>
                                            </span>
                                                  <!-- Single button -->
                                              <div class="btn-group">
                                                <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Save to Folder &nbsp; <span class="caret"></span>
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
                                              <a href="" class="btn btn-sm btn-line pull-right" title="Delete CV"><i class="fa fa-trash no-margin"></i></a>
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
                                              <span class="small">26 yrs old .   Apapa, Lagos</span><br>
                                              <!--<span class="label label-primary">INSIDIFY</span>-->
                                          <small>Trainee Software Developer- Java - <b>Zippro Systems</b></small>
                                          </h4>

                                          <div class="description">

                                            <p class="">
                                            <span class="details-small">
                                              <!-- <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span> -->
                                              <span class="small text-muted"><i class="fa fa-folder"></i> Saved to Medical Folder</span>
                                            </span>
                                                  <!-- Single button -->
                                              <div class="btn-group">
                                                <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Change Folder &nbsp; <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Medicals &nbsp; <i class="fa fa-check"></i></a></a></li>
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                  <li role="separator" class="divider"></li>

                                                  <li>
                                                      <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                  </li>
                                                </ul>
                                              </div>
                                                <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                          <span class="purchase-action">
                                              <a href="" class="btn btn-sm btn-line pull-right" title="Delete CV"><i class="fa fa-trash no-margin"></i></a>
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
                                              <span class="small">26 yrs old .   Apapa, Lagos</span><br>
                                              <!--<span class="label label-primary">INSIDIFY</span>-->
                                          <small>Trainee Software Developer- Java - <b>Zippro Systems</b></small>
                                          </h4>

                                          <div class="description">

                                            <p class="">
                                            <span class="details-small">
                                              <!-- <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span> -->
                                              <span class="small text-muted"><i class="fa fa-folder"></i> Saved to Medical Folder</span>
                                            </span>
                                                  <!-- Single button -->
                                              <div class="btn-group">
                                                <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Change Folder &nbsp; <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Medicals &nbsp; <i class="fa fa-check"></i></a></a></li>
                                                  <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                                  <li role="separator" class="divider"></li>

                                                  <li>
                                                      <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                                  </li>
                                                </ul>
                                              </div>
                                                <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                          <span class="purchase-action">
                                              <a href="" class="btn btn-sm btn-line pull-right" title="Delete CV"><i class="fa fa-trash no-margin"></i></a>
                                                <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                              <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                        </span>


                                            </p>
                                          </div>
                                  </span>

                            </li><hr>


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
              <div class="panel-group filter-div" id="accordion">


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
                          <p class="border-bottom-thin text-muted">Type<i class="glyphicon glyphicon-link pull-right"></i></p>
                          <div class="checkbox-inline">
                              <label class="normal"><input type="checkbox" class=""> Uploaded</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Saved</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Purchased</label> <br>
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
        </div>
    </section>
@endsection