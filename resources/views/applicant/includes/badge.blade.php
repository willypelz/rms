<div class="panel-group">
                    <div class="panel panel-default tweak panel-dash">
                        <div class="panel-heading">
                            <h3 class="text-brandon text-light no-margin applicant-name">{{ $appl->cv->last_name.' '.$appl->cv->first_name }}</h3>
                        </div>
                        <div class="panel-collapse">
                            <div class="row">
                              <div class="panel-body no-padding">
                                  <div class=" border-bottom-thin">
                                      <div class="col-xs-4">
                                          <div class="img-fixer" style="padding-left:5px">
                                            <img src="{{ default_picture( $appl->cv ) }}" class="img-responsive">
                                          </div>
                                      </div>
                                      <div class="col-xs-8">
                                          <p class="text-white">
                                              <span class="fa-stack">
                                                <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                              </span> {{ $appl->cv->phone }}
                                              <br/>
                                              <span class="fa-stack">
                                                <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                              </span> {{ $appl->cv->email }}
                                              <br/>
                                              <span class="fa-stack">
                                                <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
                                              </span> {{ str_replace('ago', 'old', human_time($appl->cv->date_of_birth, 1)) }}

                                            <span>{{ $appl->cv->location }}</span>
                                          </p>
                                      </div>
                                      <div class="clearfix"></div><br/>
                                  </div>
                                  <br/>
                              
                                  <div class="col-xs-12">
                                        <p><i class="fa fa-clock-o"></i> Applied: {{ date('D. d M, Y') }}</p>

                                      <hr class="">  

                                      <div class="row">
                                        <div class="col-xs-6">
                                          <a href="" class="btn btn-success btn-block" title="Send email to tosinojo23@yahoo.com">Send Message</a>
                                        </div>
                                        <div class="col-xs-6">
                                          <a href="" class="btn btn-line btn-block" title="Enlist for Interview">Enlist</a>
                                        </div>
                                      </div>

                                      <hr class="">

                                        <div class="btn-group btn-group-justified no-margin" role="group" aria-label="Justified button group with nested dropdown"> 

                                            <a title="Share Applicant" href="#" class="btn btn-line" role="button"><i class="fa fa-share-alt no-margin"></i></a> 
                                            <a title="Email Applicant" href="#" class="btn btn-line" role="button"><i class="fa fa-envelope-o no-margin"></i></a> 

                                            <a title="Make Comment on Applicant" href="#" class="btn btn-line" role="button"><i class="fa fa-comment-o no-margin"></i></a> 
                                            <a title="Enlist Applicant for an interview" href="#" class="btn btn-line" role="button"><i class="fa fa-file-text-o no-margin"></i></a> 

                                            <a title="Assess Applicant" href="#" class="btn btn-line" role="button"><i class="fa fa-question-circle no-margin"></i></a>

                                          <div class="btn-group" role="group"> 

                                            <a href="#" class="btn btn-line dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-caret-down"></i> </a> 
                                            
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

                    <div class="panel panel-default hidden">
                        <div class="panel-heading">
                            <h4 class="panel-title">Job Team</h4>
                        </div>

                        <div class="panel-collapse">
                            <div class="panel-body row">
                                <div class="col-xs-3">
                                  <a class="" href="#">
                                      <img class="media-object img-responsive" src="http://dummyimage.com/300x300/ccc/fff.jpg&text=EO" alt="">
                                  </a>
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h5>
                                    <p>Job Administrator</p>
                                    <small>
                                <span class="">
                                        <a href="#" class="">Change Role</a>
                                        &nbsp;
                                        |
                                        &nbsp;
                                        <a href="#" class="">Remove</a>
                                    </span>
                                    </small>

                                </div>
                            </div>

                            <div class="panel-body row">
                                <div class="col-xs-3">
                                  <a class="" href="#">
                                      <img class="media-object img-responsive" src="http://dummyimage.com/300x300/ccc/fff.jpg&text=EO" alt="">
                                  </a>
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h5>
                                    <p>Job Administrator</p>
                                    <small>
                                <span class="">
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