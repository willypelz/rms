@extends('layout.template-user')

@section('content')

    <section>
        <div class="container">
            <div class="row">
            <div class="col-xs-4">
                <div class="panel-group">
                    <div class="panel panel-default tweak panel-dash">
                        <div class="panel-heading">
                            <!--<p></p>-->
                            <h5 class="line2 no-margin">Applicant for: <a><b>Frontend Developer at Konga.com, Yaba, Montgomery Rd, Lagos.</a></b>
                                <!--<i class="glyphicon glyphicon-user pull-right"></i>-->
                            </h5>
                        </div>
                        <div class="panel-collapse">
                            <div class="row">
                              <div class="panel-body col-xs-12">
                                  <div class=" border-bottom-thin">
                                      <div class="col-xs-4">
                                          <img src="http://dummyimage.com/300x300/ffffff/405465.jpg&text=MB" class="img-responsive">
                                      </div>
                                      <div class="col-xs-8">
                                          <h4 class="text-brandon text-light">Mofesola Babalola</h4>
                                          <p>
                                            <span>Mettaliods Industries</span><br/>
                                            <span>Lagos, Nigeria</span>
                                          </p>
                                      </div>
                                      <div class="clearfix"></div><br/>
                                  </div>
                                  <br/>
                              
                                  <div class="col-xs-12">
                                      <p class="text-muted">
                                          <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                          </span> 08034428621
                                          <br/>
                                          <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i>
                                            <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                                          </span> mofesolababalola@mettalloids.com
                                      </p>
                                      <!--<hr class=" border-bottom-thin">-->  <br>
                                      <div class="btn-group btn-block" role="group" aria-label="...">
                                          <button type="button" class="btn" title="Share">
                                              <i class="fa fa-share-alt"></i>
                                          </button>
                                          <button type="button" class="btn" title="Send Message">
                                              <i class="fa fa-envelope-o"></i>
                                          </button>
                                          <button type="button" class="btn" title="Add Coment">
                                          <i class="fa fa-comment-o"></i>
                                          </button>
                                          <button type="button" class="btn" title="Enlist">
                                              <i class="fa fa-file-text-o"></i>
                                          </button>
                                          <button type="button" class="btn" title="Assess Applicant">
                                              <i class="fa fa-question-circle"></i>
                                          </button>
                              
                                          <div class="btn-group btn-group-last" role="group" style="">
                                              <button type="button" title="More Options" class="btn btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <!--<i class="fa fa-ellipsis-v"></i>-->
                                                  <!--&nbsp;-->
                                                  <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                  <li><a href="#">Interview</a></li>
                                                  <li><a href="#">Assign to new Job</a></li>
                                                  <li><a href="#">Reject</a></li>
                                                  <li><a href="#">Background Check</a></li>
                                                  <li><a href="#">Medicals</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Download Dossier</a></li>
                                                  <li><a href="#">Make Interview Notes</a></li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </div>

                       <!-- <div class="baser-L" title="Previous Applicant">
                            <h3 class="line1"><span class="glyphicon glyphicon-arrow-left"></span></h3>
                        </div>

                        <div class="baser-R" title="Next Applicant">
                            <h3 class="line1"><span class="glyphicon glyphicon-arrow-right"></span></h3>
                        </div> -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Progress on Applicant</h4>
                        </div>

                        <div class="panel-collapse">
                            <div class="panel-body">

                                <div class="comment media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="img/avatar.jpg" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                        </h5>
                                        <p>Job Administrator</p>
                                        <small>
                                    <span class="pull-right">
                                            <a href="#" class="">Change Role</a>
                                            &nbsp;
                                            |
                                            &nbsp;
                                            <a href="#" class="">Remove</a>
                                        </span>
                                        </small>

                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="comment media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="img/avatar.jpg" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                        </h5>
                                        <p>Job Administrator</p>
                                        <small>
                                    <span class="pull-right">
                                            <a href="#" class="">Change Role</a>
                                            &nbsp;
                                            |
                                            &nbsp;
                                            <a href="#" class="">Remove</a>
                                        </span>
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <div class="col-xs-8">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="brand.html">Profile</a>
                        </li>
                        <li><a href="jobs-for-me.html">Dialogues</a>
                        </li>
                        <li><a href="my-cv.html">Activities</a>
                        </li>
                        <!--<li class="pull-right">-->
                            <!--<span class="adj-pad">-->
                            <!--<a href="" class="pull-left"><i class="glyphicon glyphicon-circle-arrow-left"></i> Previous</a>-->
                            <!--<a href="" class="pull-right">Next <i class="glyphicon glyphicon-circle-arrow-right"></i></a>-->
                            <!--</span>-->
                        <!--</li>-->
                    </ul>

                    <div class="tab-content" id="">


                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="glyphicon glyphicon-file"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>PERSONAL INFO</h5>
                                    <p class="text-muted">Medical Doctor, Entrepreneur, Passionate about change and excellence</p>
                                    <ul class="list-unstyled">
                                        <li>
                                            <strong>Sex:</strong>&nbsp; Male</li>
                                        <li>
                                            <strong>Email:</strong>&nbsp; emmanuel@insidify.com</li>
                                        <li>
                                            <strong>Phone:</strong>&nbsp; 08068873719</li>
                                        <li>
                                            <strong>Age:</strong>&nbsp; 27 years old
                                            <span class="text-muted">(Oct 01, 1987)</span>
                                        </li>
                                        <li>
                                            <strong>Address:</strong>&nbsp; Magodo GRA, Lagos.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="glyphicon glyphicon-wrench"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>SKILLS</h5>
                                    <p class="text-muted">Medical Doctor, Entrepreneur, Public Speaker</p>
                                </div>
                            </div>
                        </div>

                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="glyphicon glyphicon-briefcase"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>WORK EXPERIENCE</h5>

                                    <div class="sub-box">
                                        <p class="text-muted">May 2013 - present</p>
                                        <h5>Co-founder and CEO at <a href="#">Insidify.com</a>
                                        </h5>
                                        <p>Lagos, Nigeria</p>
                                    </div>

                                    <div class="sub-box">
                                        <p class="text-muted">Apr 2012 - Apr 2013</p>
                                        <h5>House Physician at <a href="#">St. Nicholas Hospital Lagos</a>
                                        </h5>
                                        <p>Lagos, Nigeria</p>
                                    </div>

                                    <div class="sub-box">
                                        <p class="text-muted">Dec 2007 - present</p>
                                        <h5>Head Business Development at <a href="#">Waressence</a>
                                        </h5>
                                        <p>Lagos, Nigeria</p>
                                    </div>

                                    <div class="sub-box">
                                        <p class="text-muted">Dec 1999 - present</p>
                                        <h5>Curator at <a href="#">Employment Edge</a>
                                        </h5>
                                        <p>Lagos, Nigeria</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>EDUCATION</h5>

                                    <div class="sub-box">
                                        <p class="text-muted">Aug 2003 - Aug 2011</p>
                                        <h5>Medicine and Surgery at Obafemi Awolowo University</h5>
                                        <p>M.B.ch.B, Pass</p>
                                    </div>

                                    <div class="sub-box">
                                        <p class="text-muted">Jan 1970 - Dec 2003</p>
                                        <h5>Hallmark Secondary School</h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="glyphicon glyphicon-link"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>LINKS</h5>
                                    <ul class="list-unstyled">
                                        <li><a href="http://www.facebook.com/olamide.okeleji">http://www.facebook.com/olamide.okeleji</a>
                                        </li>
                                        <li><a href="#">http://twitter.com/@okeleji</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--/tab-content-->

                </div>

            </div>
        </div>
    </section>

<div class="separator separator-small"></div>

@endsection