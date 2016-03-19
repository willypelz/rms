@extends('layout.template-user')

@section('content')

<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">

                    <div class="row text-center">
                        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                            <h5 class="no-margin text-uppercase l-sp-5 text-brandon">Promote your Job</h5>
                        </div>
                    </div>

            <div class="row">

                <div class="col-sm-12">
                    <br>
                    <div class="page">

                        <div class="btn-group btn-group-justified text-uppercase btn-progress" role="group" aria-label="...">
                          <!-- <div class="btn-group" role="group">
                            <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">1. job details</span></a>
                          </div> -->
                          <div class="btn-group" role="group">
                            <a href="" type="button" class="btn btn-primary text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs"> advertise</span></a>
                          </div>
                          
                          <div class="btn-group" role="group">
                            <a href="share-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs"> sharing</span></a>
                          </div>

                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs"> add candidates</span></a>
                          </div>
                        </div>
                        <div class="row">
                            
                            
                            <div class="col-md-10 col-md-offset-1"><br>
                            <div class="alert alert-success">
                                <div class="col-xs-7">
                                    <i class="fa fa-check"></i> You Job has been successfully posted on <b>Insidify.com</b>, <b>hotnigeriajob.com</b>. <br>
                                </div>

                                <div class="col-xs-5">
                                
                                    <div id="collapseWellCart" class="well well-cart animated slideInUp collapse no-margin">
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
                                </div>
                                <div class="clearfix"></div>
                            </div>
                                <div>
                                    <div class="row">
                                    <div class="col-xs-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis voluptatum unde, placeat repellendus dolores, nam enim eveniet earum eius molestiae explicabo in architecto maiores quaerat voluptatibus iste laudantium quo natus.</p><br>
                                        <h5 class="text-brandon text-uppercase">
                                        <i class="fa fa-star"></i>&nbsp; Paid Job Board 
                                        </h5><br>
                                    </div>
                                        <div class="col-sm-6"> 
                                            <div class="thumbnail">  
                                                <div class="caption">
                                            <img alt="{{Job Provider name}}" src="http://www.jobberman.com/img/new/logo.png" height="45px"> <hr>
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
                                            <img alt="{{Job Provider name}}" src="http://www.myjobmag.com/pics/logo6.png"  height="45px"> <hr>
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
                                            <img alt="{{Job Provider name}}" src="http://www.hotnigerianjobs.com/images/banner2.gif"  height="45px"> <hr>
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
                                            <img alt="{{Job Provider name}}" src="http://www.hotnigerianjobs.com/images/banner2.gif"  height="45px"> <hr>
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
                                        <div class="col-sm-12"><hr><a href="share-job.php" class="pull-right btn btn-danger btn-cart-checkout disabled">Proceed to payment &raquo;</a></div>
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