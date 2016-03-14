@extends('layout.template-user')

@section('content')
  <div class="separator separator-small"></div>
    <section class="s-div green about hidden">
        <div class="container">

            <div class="row pagehead text-center">
                <h1>About Us</h1>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h4 class="no-margin text-center text-uppercase l-sp-5">Job Creation</h4><br>
                    <div class="page">

                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">1. job details</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="advertise-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">2. advertise</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="share-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">3. sharing</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-primary text-capitalize text-muted"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">4. add candidates</span></a>
                          </div>
                        </div>

        <div class="row">
        </div>
                        <div class="row">
                            
                            
                            <div class="col-xs-12">
                                <div class="row tab-content ">
                                <div class="col-sm-12 text-center">

                                <h4 class="text-center">Add Candidates to this Job</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <hr>

                                    
                                    <div class="col-sm-4">
                                        <a href="job-board.php" type="button" class="btn btn-success text-capitalize"><i class="fa fa-envelope-o"></i>
                                            &nbsp; <span class="hidden-xs">Import from Email</span>
                                        </a><p></p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem eos at ducimus ratione asperiores aliquid temporibus veritatis nam, natus, praesentium aliquam. Adipisci aperiam cum explicabo, voluptatem, molestias eligendi officia beatae.
                                        </p>
                                    </div>

                                    <div class="col-sm-4">
                                        <a href="job-board.php" type="button" class="btn btn-success text-capitalize"><i class="fa fa-file-text-o"></i>
                                            &nbsp; <span class="hidden-xs">Import from file</span>
                                        </a><p></p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni veniam cumque neque ipsum, id in, nihil sapiente et harum consequuntur expedita ea unde nulla nostrum pariatur nesciunt, dolore soluta ipsa.
                                        </p>
                                    </div>


                                    <div class="col-sm-4">
                                        <a href="job-board.php" type="button" class="btn btn-success text-capitalize"><i class="fa fa-user-md"></i>
                                            &nbsp; <span class="hidden-xs">Find Matching Candidates</span>
                                        </a><p></p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia suscipit, enim minus pariatur vitae eum reiciendis? Laborum quasi repudiandae ad aliquam, qui veniam ex ut at eveniet iste, facere sequi.
                                        </p>
                                    </div>

                                    <div class="col-sm-12">
                                        <hr>

                                    <h5 class="no-margin text-center text-success">
                                            <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                                            Importing Candidates
                                        </h5>

                                    </div>
                                </div>

                                <div class="applicant-div ">
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
                                    <div class="col-xs-4 col-xs-offset-4"><hr>
                                        <a href="{{ url('jobs/dashboard') }}" class="btn btn-block btn-primary">Proceed to Job Dashboard &raquo;</a>
                                    </div>
                                </div>

                    </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"></div>
@endsection