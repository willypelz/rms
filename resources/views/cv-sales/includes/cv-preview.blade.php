
            <div class="">
            <div class="container">

                <div class="row">

            <div class="col-xs-10 col-xs-offset-1 view">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<br>
                
                <div class="row">
                    <div class="col-xs-5 ">
                        
                          <p class="hide">
                                <!-- Single button -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-line btn-sm dropdown-toggle hide" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


                                          <span class="purchase-action hidden">
                                                <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                              <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                        </span>
                          </p>
                    </div>

                    <div class="col-xs-2">
                        <div class="text-center cv-portrait">
                            <img src="{{ default_picture( $cv ) }}" class="img-circle">
                        </div>
                    </div>

                    <div class="col-xs-5">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="tab-content stack" id="cv">
                    <pre>
                        {{ remove_cv_contact( $cv['extracted_content'][0] ) }}
                    </pre>
                </div>
   
                <div class="tab-content stack hidden" id="cv">
                    
                    <div class="row">
                        <div class="col-xs-12 cv-name text-center">
                            <h2>Ernest Ojeh</h2>
                            <p class="text-muted">Designer &amp; Something else at <a href="#">Google Inc.</a>
                            </p>
                            <hr>
                        </div>
                    </div>

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
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <!--/tab-content-->

            </div>


            </div>
            </div>
            </div>
