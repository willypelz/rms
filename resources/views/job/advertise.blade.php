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

                        <div class="btn-group btn-group-justified text-uppercase btn-progress" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">1. job details</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">advertise</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-muted text-capitalize disabled"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">3. sharing</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-muted text-capitalize disabled"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">4. add candidates</span></button>
                          </div>
                        </div>
                        <div class="row">
                            
                            
                            <div class="col-md-8 col-md-offset-2"><br>
                                <h6 class="text-uppercase text-center">Post this job on</h6>
                                <div class="row">
                                <div class="col-xs-12">
                                        <h5 class="text-brandon text-uppercase">
                                        Free Job Board 
                                        <span class="pull-right"><i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i></span>
                                        </h5><hr>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="thumbnail">
                                            <div class="caption"> 
                                        <img alt="Job Provider name" src="http://insidify.com/desktop/img/logo.png" width="60%" height="">  <hr>
                                                <h4 class="">Insidify.com</h4>
                                                <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                                                <p class="text-success">

                                                          <button class="btn btn-line" data-count="1" data-cost="500"><i class="fa fa-check"></i> Added to Cart for free </button>

                                                </p> 
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                                <div class="alert alert-info" style="background: rgba(217, 237, 247, 0.22)">
                                    <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h5 class="text-brandon text-uppercase">
                                        <i class="fa fa-star"></i>&nbsp; Premium Job Board &nbsp;<i class="fa fa-star"></i> 
                                        </h5><br>
                                    </div>
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail">  
                                                <div class="caption">
                                            <img alt="Job Provider name" src="http://www.jobberman.com/img/new/logo.png" width="60%" height=""> <hr>
                                                    <h4 class="">Jobberman.com</h4>
                                                    <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                                                    <p>

                                                      <span class="purchase-action">
                                                            <a href="" class="btn btn-success btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Post for &#8358; 500</a>
                                                          <button class="btn btn-line btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                    </span>

                                                    </p> 
                                                </div> 
                                            </div> 
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail"> 
                                                <div class="caption"> 
                                            <img alt="Job Provider name" src="http://www.myjobmag.com/pics/logo6.png" width="60%" height=""> <hr>
                                                    <h4 class="">My JobMag</h4>
                                                    <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                                                    <p><!-- <a href="#" class="btn btn-success" role="button">&plus; Add to Cart for &#8358;2000</a> --> 
                                                    <!-- <a href="#" class="btn btn-default" role="button">Button</a> -->


                                                      <span class="purchase-action">
                                                            <a href="" class="btn btn-success btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Post for &#8358; 500</a>
                                                          <button class="btn btn-line btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                    </span>

                                                    </p> 
                                                </div> 
                                            </div> 
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail"> 
                                                <div class="caption"> 
                                            <img alt="Job Provider name" src="http://www.hotnigerianjobs.com/images/banner2.gif" width="60%" height=""> <hr>
                                                    <h4 class="">Hot Nigerian Jobs</h4>
                                                    <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                                                    <p>

                                                      <span class="purchase-action">
                                                            <a href="" class="btn btn-success btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Post for &#8358; 500</a>
                                                          <button class="btn btn-line btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                    </span>

                                                    </p> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail"> 
                                                <div class="caption"> 
                                            <img alt="Job Provider name" src="http://www.hotnigerianjobs.com/images/banner2.gif" width="60%" height=""> <hr>
                                                    <h4 class="">Hot Nigerian Jobs</h4>
                                                    <p class="small">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> 
                                                    <p>

                                                      <span class="purchase-action">
                                                            <a href="" class="btn btn-success btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Post for &#8358; 500</a>
                                                          <button class="btn btn-line btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                    </span>

                                                    </p>  
                                                </div> 
                                            </div> 
                                        </div> 
                                        <div class="col-sm-12"><hr><a href="{{ url('jobs/share') }}" class="pull-right btn btn-primary">Save and Proceed &raquo;</a></div>
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